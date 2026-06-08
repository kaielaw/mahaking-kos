<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Lokasi;
use App\Models\FotoKos;
use App\Models\DetailFasilitas;
use App\Models\Fasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerKosController extends Controller
{
    private function getPemilikId(): string
    {
        $pemilik = Auth::user()->pemilikKos;
        if (!$pemilik) abort(403, 'Data pemilik tidak ditemukan.');
        return $pemilik->id_pemilik;
    }

    // Buat ID unik max 5 char sesuai migration varchar(5)
    private function uniqueId(string $prefix, string $table, string $column): string
    {
        do {
            $id = $prefix . strtoupper(Str::random(4));
        } while (\DB::table($table)->where($column, $id)->exists());
        return $id;
    }

    // INDEX
    public function index()
    {
        $dataKos = Kos::with(['lokasi', 'fotoKos'])
            ->where('id_pemilik', $this->getPemilikId())
            ->latest()
            ->get();

        return view('owner.kos.index', compact('dataKos'));
    }

    // CREATE
    public function create()
    {
        return view('kos.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'nama_kos'     => 'required|string|max:100',
            'jenis_kos'    => 'required|in:putra,putri,campur',
            'tipe_kos'     => 'required|string|max:50',
            'deskripsi'    => 'required|string',
            'aturan_kos'   => 'required|string',
            'alamat'       => 'required|string',
            'kecamatan'    => 'nullable|string|max:50',
            'kota'         => 'nullable|string|max:50',
            'provinsi'     => 'nullable|string|max:50',
            'harga_min'    => 'required|numeric|min:0',
            'harga_max'    => 'nullable|numeric|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'foto_kos'     => 'nullable|array',
            'foto_kos.*'   => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'fasilitas'    => 'nullable|array',
        ]);

        // 1. Simpan Lokasi — generate ID manual
        $idLokasi = $this->uniqueId('L', 'lokasi', 'id_lokasi');
        $lokasi = new Lokasi();
        $lokasi->id_lokasi  = $idLokasi;
        $lokasi->kecamatan  = $request->kecamatan ?? '-';
        $lokasi->kota       = $request->kota ?? '-';
        $lokasi->provinsi   = $request->provinsi ?? '-';
        $lokasi->save();

        // 2. Simpan Kos — generate ID manual
        $idKos = $this->uniqueId('K', 'kos', 'id_kos');
        $kos = new Kos();
        $kos->id_kos                = $idKos;
        $kos->id_pemilik            = $this->getPemilikId();
        $kos->id_lokasi             = $idLokasi;
        $kos->nama_kos              = $request->nama_kos;
        $kos->jenis_kos             = $request->jenis_kos;
        $kos->tipe_kos              = $request->tipe_kos;
        $kos->deskripsi             = $request->deskripsi;
        $kos->aturan_kos            = $request->aturan_kos;
        $kos->alamat                = $request->alamat;
        $kos->harga_min             = $request->harga_min;
        $kos->harga_max             = $request->harga_max ?? $request->harga_min;
        $kos->jumlah_kamar          = $request->jumlah_kamar;
        $kos->jumlah_kamar_tersedia = $request->jumlah_kamar;
        $kos->status_ketersediaan   = 'tersedia';
        $kos->status_verifikasi     = 'pending';
        $kos->save();

        // 3. Simpan Fasilitas
        if ($request->filled('fasilitas')) {
            foreach ($request->fasilitas as $namaFas) {
                // Cari atau buat fasilitas
                $fas = Fasilitas::where('nama_fasilitas', $namaFas)->first();
                if (!$fas) {
                    $fas = new Fasilitas();
                    $fas->id_fasilitas  = $this->uniqueId('F', 'fasilitas', 'id_fasilitas');
                    $fas->nama_fasilitas = $namaFas;
                    $fas->save();
                }
                // Simpan detail fasilitas
                $df = new DetailFasilitas();
                $df->id_detail_fasilitas = $this->uniqueId('D', 'detail_fasilitas', 'id_detail_fasilitas');
                $df->id_kos              = $idKos;
                $df->id_fasilitas        = $fas->id_fasilitas;
                $df->keterangan          = $namaFas;
                $df->save();
            }
        }

        // 4. Upload foto
        if ($request->hasFile('foto_kos')) {
            $urutan = 1;
            foreach ($request->file('foto_kos') as $foto) {
                $path   = $foto->store('kos/' . $idKos, 'public');
                $idFoto = $this->uniqueId('F', 'foto_kos', 'id_foto');
                $fk = new FotoKos();
                $fk->id_foto  = $idFoto;
                $fk->id_kos   = $idKos;
                $fk->url_foto = Storage::url($path);
                $fk->caption  = 'Foto kos ' . $urutan++;
                $fk->save();
            }
        }

        return redirect()->route('owner.kos.index')
            ->with('success', 'Kos berhasil ditambahkan!');
    }

    // EDIT
    public function edit($id)
    {
        $kos = Kos::with(['lokasi', 'fotoKos', 'detailFasilitas.fasilitas'])
            ->where('id_pemilik', $this->getPemilikId())
            ->findOrFail($id);

        return view('kos.edit', compact('kos'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $kos = Kos::where('id_pemilik', $this->getPemilikId())->findOrFail($id);

        $request->validate([
            'nama_kos'     => 'required|string|max:100',
            'jenis_kos'    => 'required|in:putra,putri,campur',
            'tipe_kos'     => 'required|string|max:50',
            'deskripsi'    => 'required|string',
            'aturan_kos'   => 'required|string',
            'alamat'       => 'required|string',
            'kecamatan'    => 'nullable|string|max:50',
            'kota'         => 'nullable|string|max:50',
            'provinsi'     => 'nullable|string|max:50',
            'harga_min'    => 'required|numeric|min:0',
            'jumlah_kamar' => 'required|integer|min:1',
            'foto_kos'     => 'nullable|array',
            'foto_kos.*'   => 'image|mimes:jpg,jpeg,png,webp|max:5120',
            'hapus_foto'   => 'nullable|array',
        ]);

        // Update lokasi
        if ($kos->lokasi) {
            $kos->lokasi->kecamatan = $request->kecamatan ?? $kos->lokasi->kecamatan;
            $kos->lokasi->kota      = $request->kota ?? $kos->lokasi->kota;
            $kos->lokasi->provinsi  = $request->provinsi ?? $kos->lokasi->provinsi;
            $kos->lokasi->save();
        } else {
            $idLokasi = $this->uniqueId('L', 'lokasi', 'id_lokasi');
            $lokasi = new Lokasi();
            $lokasi->id_lokasi = $idLokasi;
            $lokasi->kecamatan = $request->kecamatan ?? '-';
            $lokasi->kota      = $request->kota ?? '-';
            $lokasi->provinsi  = $request->provinsi ?? '-';
            $lokasi->save();
            $kos->id_lokasi = $idLokasi;
        }

        $kos->nama_kos     = $request->nama_kos;
        $kos->jenis_kos    = $request->jenis_kos;
        $kos->tipe_kos     = $request->tipe_kos;
        $kos->deskripsi    = $request->deskripsi;
        $kos->aturan_kos   = $request->aturan_kos;
        $kos->alamat       = $request->alamat;
        $kos->harga_min    = $request->harga_min;
        $kos->jumlah_kamar = $request->jumlah_kamar;
        $kos->save();

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
                $idFoto = $this->uniqueId('F', 'foto_kos', 'id_foto');
                $fk = new FotoKos();
                $fk->id_foto  = $idFoto;
                $fk->id_kos   = $kos->id_kos;
                $fk->url_foto = Storage::url($path);
                $fk->caption  = 'Foto kos ' . $urutan++;
                $fk->save();
            }
        }

        return redirect()->route('owner.kos.index')
            ->with('success', 'Data kos berhasil diperbarui!');
    }

    // DESTROY
    public function destroy($id)
    {
        $kos = Kos::with('fotoKos')
            ->where('id_pemilik', $this->getPemilikId())
            ->findOrFail($id);

        foreach ($kos->fotoKos as $foto) {
            $rel = ltrim(str_replace('/storage', '', $foto->url_foto), '/');
            Storage::disk('public')->delete($rel);
        }
        $kos->delete();

        return redirect()->route('owner.kos.index')
            ->with('success', 'Kos berhasil dihapus.');
    }
}