<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Lokasi;
use App\Models\FotoKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerKosController extends Controller
{
    private function getPemilikId(): string
    {
        $pemilik = Auth::user()->pemilikKos;
        if (!$pemilik) abort(403, 'Data pemilik kos tidak ditemukan.');
        return $pemilik->id_pemilik;
    }

    // ── Buat ID unik max 5 char ──────────────────
    private function generateId(string $prefix, string $model): string
    {
        // prefix = 'K', sisa = 4 char → total 5 char (sesuai migration varchar(5))
        do {
            $id = $prefix . strtoupper(Str::random(4));
        } while ($model::where((new $model)->getKeyName(), $id)->exists());
        return $id;
    }

    // ─────────────────────────────────────────────
    //  INDEX — GET /owner/kos
    // ─────────────────────────────────────────────
    public function index()
    {
        $dataKos = Kos::with(['lokasi', 'fotoKos'])
            ->where('id_pemilik', $this->getPemilikId())
            ->latest()
            ->get();

        // View: resources/views/owner/index.blade.php
        // (halaman data kos ada di owner/index yang sudah include tabel)
        return view('owner.kos.index', compact('dataKos'));
    }

    // ─────────────────────────────────────────────
    //  CREATE — GET /owner/kos/create
    // ─────────────────────────────────────────────
    public function create()
    {
        return view('kos.create');
    }

    // ─────────────────────────────────────────────
    //  STORE — POST /owner/kos
    // ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'nama_kos'     => 'required|string|max:100',
            'jenis_kos'    => 'required|in:putra,putri,campur',
            'tipe_kos'     => 'required|string|max:50',     // NOT NULL di migration
            'deskripsi'    => 'required|string',             // NOT NULL di migration
            'aturan_kos'   => 'required|string',             // NOT NULL di migration
            'alamat'       => 'required|string|max:300',
            'kecamatan'    => 'nullable|string|max:50',
            'kota'         => 'nullable|string|max:50',
            'provinsi'     => 'nullable|string|max:50',
            'harga_min'    => 'required|numeric|min:0',
            'harga_max'    => 'nullable|numeric|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'foto_kos'     => 'nullable|array',
            'foto_kos.*'   => 'image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'nama_kos.required'     => 'Nama kos wajib diisi.',
            'jenis_kos.required'    => 'Pilih jenis kos.',
            'tipe_kos.required'     => 'Tipe kos wajib diisi.',
            'deskripsi.required'    => 'Deskripsi wajib diisi.',
            'aturan_kos.required'   => 'Aturan kos wajib diisi.',
            'alamat.required'       => 'Alamat wajib diisi.',
            'harga_min.required'    => 'Harga minimum wajib diisi.',
            'jumlah_kamar.required' => 'Jumlah kamar wajib diisi.',
        ]);

        DB::transaction(function () use ($request) {

            // 1. Generate ID lokasi (max 5 char)
            $idLokasi = 'L' . strtoupper(Str::random(4));
            $lokasi = Lokasi::create([
                'id_lokasi'  => $idLokasi,
                'kecamatan'  => $request->kecamatan ?? '-',
                'kota'       => $request->kota ?? '-',
                'provinsi'   => $request->provinsi ?? '-',
            ]);

            // 2. Generate ID kos (max 5 char)
            $idKos = $this->generateId('K', Kos::class);

            $kos = Kos::create([
                'id_kos'                => $idKos,
                'id_pemilik'            => $this->getPemilikId(),
                'id_lokasi'             => $lokasi->id_lokasi,
                'nama_kos'              => $request->nama_kos,
                'jenis_kos'             => $request->jenis_kos,
                'tipe_kos'              => $request->tipe_kos,
                'deskripsi'             => $request->deskripsi,
                'aturan_kos'            => $request->aturan_kos,
                'alamat'                => $request->alamat,
                'harga_min'             => $request->harga_min,
                'harga_max'             => $request->harga_max ?? $request->harga_min,
                'jumlah_kamar'          => $request->jumlah_kamar,
                'jumlah_kamar_tersedia' => $request->jumlah_kamar,
                'status_ketersediaan'   => 'tersedia',
                'status_verifikasi'     => 'pending',
            ]);

            // 3. Upload foto — id_foto & caption wajib (NOT NULL di migration)
            if ($request->hasFile('foto_kos')) {
                $urutan = 1;
                foreach ($request->file('foto_kos') as $foto) {
                    $path    = $foto->store('kos/' . $kos->id_kos, 'public');
                    $idFoto  = 'F' . strtoupper(Str::random(4));
                    FotoKos::create([
                        'id_foto'  => $idFoto,
                        'id_kos'   => $kos->id_kos,
                        'url_foto' => Storage::url($path),
                        'caption'  => 'Foto kos ' . $urutan++,  // caption NOT NULL
                    ]);
                }
            }
        });

        return redirect()->route('owner.kos.index')
            ->with('success', 'Kos berhasil ditambahkan!');
    }

    // ─────────────────────────────────────────────
    //  EDIT — GET /owner/kos/{id}/edit
    // ─────────────────────────────────────────────
    public function edit($id)
    {
        $kos = Kos::with(['lokasi', 'fotoKos'])
            ->where('id_pemilik', $this->getPemilikId())
            ->findOrFail($id);

        return view('kos.edit', compact('kos'));
    }

    // ─────────────────────────────────────────────
    //  UPDATE — PUT /owner/kos/{id}
    // ─────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $kos = Kos::where('id_pemilik', $this->getPemilikId())->findOrFail($id);

        $request->validate([
            'nama_kos'     => 'required|string|max:100',
            'jenis_kos'    => 'required|in:putra,putri,campur',
            'tipe_kos'     => 'required|string|max:50',
            'deskripsi'    => 'required|string',
            'aturan_kos'   => 'required|string',
            'alamat'       => 'required|string|max:300',
            'kecamatan'    => 'nullable|string|max:50',
            'kota'         => 'nullable|string|max:50',
            'provinsi'     => 'nullable|string|max:50',
            'harga_min'    => 'required|numeric|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'foto_kos'     => 'nullable|array',
            'foto_kos.*'   => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'hapus_foto'   => 'nullable|array',
            'hapus_foto.*' => 'string',
        ]);

        DB::transaction(function () use ($request, $kos) {
            if ($kos->lokasi) {
                $kos->lokasi->update([
                    'kecamatan' => $request->kecamatan ?? $kos->lokasi->kecamatan,
                    'kota'      => $request->kota ?? $kos->lokasi->kota,
                    'provinsi'  => $request->provinsi ?? $kos->lokasi->provinsi,
                ]);
            } else {
                $idLokasi = 'L' . strtoupper(Str::random(4));
                $lokasi = Lokasi::create([
                    'id_lokasi' => $idLokasi,
                    'kecamatan' => $request->kecamatan ?? '-',
                    'kota'      => $request->kota ?? '-',
                    'provinsi'  => $request->provinsi ?? '-',
                ]);
                $kos->id_lokasi = $lokasi->id_lokasi;
            }

            $kos->update([
                'nama_kos'     => $request->nama_kos,
                'jenis_kos'    => $request->jenis_kos,
                'tipe_kos'     => $request->tipe_kos,
                'deskripsi'    => $request->deskripsi,
                'aturan_kos'   => $request->aturan_kos,
                'alamat'       => $request->alamat,
                'harga_min'    => $request->harga_min,
                'jumlah_kamar' => $request->jumlah_kamar,
            ]);

            // Hapus foto yang dipilih
            if ($request->filled('hapus_foto')) {
                foreach ($request->hapus_foto as $idFoto) {
                    $foto = FotoKos::find($idFoto);
                    if ($foto) {
                        $rel = ltrim(str_replace('/storage', '', $foto->url_foto), '/');
                        Storage::disk('public')->delete($rel);
                        $foto->delete();
                    }
                }
            }

            // Upload foto baru
            if ($request->hasFile('foto_kos')) {
                $urutan = $kos->fotoKos()->count() + 1;
                foreach ($request->file('foto_kos') as $foto) {
                    $path   = $foto->store('kos/' . $kos->id_kos, 'public');
                    $idFoto = 'F' . strtoupper(Str::random(4));
                    FotoKos::create([
                        'id_foto'  => $idFoto,
                        'id_kos'   => $kos->id_kos,
                        'url_foto' => Storage::url($path),
                        'caption'  => 'Foto kos ' . $urutan++,
                    ]);
                }
            }
        });

        return redirect()->route('owner.kos.index')
            ->with('success', 'Data kos berhasil diperbarui!');
    }

    // ─────────────────────────────────────────────
    //  DESTROY — DELETE /owner/kos/{id}
    // ─────────────────────────────────────────────
    public function destroy($id)
    {
        $kos = Kos::with('fotoKos')
            ->where('id_pemilik', $this->getPemilikId())
            ->findOrFail($id);

        DB::transaction(function () use ($kos) {
            foreach ($kos->fotoKos as $foto) {
                $rel = ltrim(str_replace('/storage', '', $foto->url_foto), '/');
                Storage::disk('public')->delete($rel);
            }
            $kos->delete();
        });

        return redirect()->route('owner.kos.index')
            ->with('success', 'Kos berhasil dihapus.');
    }
}