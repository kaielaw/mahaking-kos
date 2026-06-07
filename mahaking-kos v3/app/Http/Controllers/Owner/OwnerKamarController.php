<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kos;
use App\Models\Fasilitas;
use App\Models\DetailFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OwnerKamarController extends Controller
{
    /** Ambil id_pemilik milik user yang sedang login */
    private function getPemilikId(): string
    {
        $pemilik = Auth::user()->pemilikKos;
        if (!$pemilik) abort(403, 'Data pemilik tidak ditemukan.');
        return $pemilik->id_pemilik;
    }

    // ─────────────────────────────────────────────
    //  INDEX
    //  GET /owner/kamar
    // ─────────────────────────────────────────────
    public function index()
    {
        $dataKamar = Kamar::with('kos')
            ->whereHas('kos', function ($q) {
                $q->where('id_pemilik', $this->getPemilikId());
            })
            ->latest()
            ->get();

        return view('kamar.index', compact('dataKamar'));
    }

    // ─────────────────────────────────────────────
    //  CREATE
    //  GET /owner/kamar/create
    // ─────────────────────────────────────────────
    public function create()
    {
        $dataKos = Kos::where('id_pemilik', $this->getPemilikId())
            ->orderBy('nama_kos')
            ->get(['id_kos', 'nama_kos']);

        return view('kamar.create', compact('dataKos'));
    }

    // ─────────────────────────────────────────────
    //  STORE
    //  POST /owner/kamar
    // ─────────────────────────────────────────────
    public function store(Request $request)
    {
        $request->validate([
            'id_kos'             => 'required|exists:kos,id_kos',
            'nomor_kamar'        => 'nullable|string|max:20',
            'ukuran'             => 'nullable|string|max:50',
            'tipe_kamar'         => 'nullable|string|max:100',
            'harga_per_bulan'    => 'required|numeric|min:0',
            'harga_per_tahun'    => 'nullable|numeric|min:0',
            'ketersediaan_kamar' => 'required|in:tersedia,terisi',
            'fasilitas'          => 'nullable|array',
            'fasilitas.*'        => 'string|max:100',
        ], [
            'id_kos.required'          => 'Pilih kos terlebih dahulu.',
            'harga_per_bulan.required' => 'Harga per bulan wajib diisi.',
        ]);

        // Pastikan kos milik pemilik ini
        Kos::where('id_kos', $request->id_kos)
            ->where('id_pemilik', $this->getPemilikId())
            ->firstOrFail();

        DB::transaction(function () use ($request) {
            $kamar = Kamar::create([
                'id_kamar'           => 'KMR-' . strtoupper(Str::random(8)),
                'id_kos'             => $request->id_kos,
                'nomor_kamar'        => $request->nomor_kamar,
                'ukuran'             => $request->ukuran,
                'tipe_kamar'         => $request->tipe_kamar,
                'harga_per_bulan'    => $request->harga_per_bulan,
                'harga_per_tahun'    => $request->harga_per_tahun ?? ($request->harga_per_bulan * 12),
                'ketersediaan_kamar' => $request->ketersediaan_kamar,
            ]);

            // Simpan fasilitas ke detail_fasilitas
            if ($request->filled('fasilitas')) {
                foreach ($request->fasilitas as $namaFas) {
                    $fasilitas = Fasilitas::firstOrCreate(
                        ['nama_fasilitas' => $namaFas],
                        ['id_fasilitas' => 'FAS-' . strtoupper(Str::random(8))]
                    );
                    DetailFasilitas::firstOrCreate([
                        'id_kos'       => $request->id_kos,
                        'id_fasilitas' => $fasilitas->id_fasilitas,
                    ], [
                        'id_detail_fasilitas' => 'DFS-' . strtoupper(Str::random(8)),
                    ]);
                }
            }

            // Update jumlah_kamar_tersedia di kos
            $this->updateKamarTersedia($request->id_kos);
        });

        return redirect()->route('owner.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    // ─────────────────────────────────────────────
    //  EDIT
    //  GET /owner/kamar/{id}/edit
    // ─────────────────────────────────────────────
    public function edit($id)
    {
        $kamar = Kamar::with('kos')
            ->whereHas('kos', function ($q) {
                $q->where('id_pemilik', $this->getPemilikId());
            })
            ->findOrFail($id);

        $dataKos = Kos::where('id_pemilik', $this->getPemilikId())
            ->orderBy('nama_kos')
            ->get(['id_kos', 'nama_kos']);

        return view('kamar.edit', compact('kamar', 'dataKos'));
    }

    // ─────────────────────────────────────────────
    //  UPDATE
    //  PUT /owner/kamar/{id}
    // ─────────────────────────────────────────────
    public function update(Request $request, $id)
    {
        $kamar = Kamar::whereHas('kos', function ($q) {
            $q->where('id_pemilik', $this->getPemilikId());
        })->findOrFail($id);

        $request->validate([
            'nomor_kamar'        => 'nullable|string|max:20',
            'ukuran'             => 'nullable|string|max:50',
            'tipe_kamar'         => 'nullable|string|max:100',
            'harga_per_bulan'    => 'required|numeric|min:0',
            'harga_per_tahun'    => 'nullable|numeric|min:0',
            'ketersediaan_kamar' => 'required|in:tersedia,terisi',
            'fasilitas'          => 'nullable|array',
            'fasilitas.*'        => 'string|max:100',
        ]);

        DB::transaction(function () use ($request, $kamar) {
            $kamar->update([
                'nomor_kamar'        => $request->nomor_kamar,
                'ukuran'             => $request->ukuran,
                'tipe_kamar'         => $request->tipe_kamar,
                'harga_per_bulan'    => $request->harga_per_bulan,
                'harga_per_tahun'    => $request->harga_per_tahun ?? ($request->harga_per_bulan * 12),
                'ketersediaan_kamar' => $request->ketersediaan_kamar,
            ]);

            // Update fasilitas
            if ($request->has('fasilitas')) {
                DetailFasilitas::where('id_kos', $kamar->id_kos)->delete();
                foreach ($request->fasilitas as $namaFas) {
                    $fasilitas = Fasilitas::firstOrCreate(
                        ['nama_fasilitas' => $namaFas],
                        ['id_fasilitas' => 'FAS-' . strtoupper(Str::random(8))]
                    );
                    DetailFasilitas::create([
                        'id_detail_fasilitas' => 'DFS-' . strtoupper(Str::random(8)),
                        'id_kos'              => $kamar->id_kos,
                        'id_fasilitas'        => $fasilitas->id_fasilitas,
                    ]);
                }
            }

            // Update harga_min dan jumlah_kamar_tersedia di kos
            $this->updateKamarTersedia($kamar->id_kos);
            $hargaMin = Kamar::where('id_kos', $kamar->id_kos)->min('harga_per_bulan');
            Kos::where('id_kos', $kamar->id_kos)->update(['harga_min' => $hargaMin]);
        });

        return redirect()->route('owner.kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui!');
    }

    // ─────────────────────────────────────────────
    //  DESTROY
    //  DELETE /owner/kamar/{id}
    // ─────────────────────────────────────────────
    public function destroy($id)
    {
        $kamar = Kamar::whereHas('kos', function ($q) {
            $q->where('id_pemilik', $this->getPemilikId());
        })->findOrFail($id);

        $idKos = $kamar->id_kos;
        $kamar->delete();

        $this->updateKamarTersedia($idKos);
        $hargaMin = Kamar::where('id_kos', $idKos)->min('harga_per_bulan');
        Kos::where('id_kos', $idKos)->update(['harga_min' => $hargaMin ?? 0]);

        return redirect()->route('owner.kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }

    // ─────────────────────────────────────────────
    //  PRIVATE — Update jumlah kamar tersedia di tabel kos
    // ─────────────────────────────────────────────
    private function updateKamarTersedia(string $idKos): void
    {
        $tersedia = Kamar::where('id_kos', $idKos)
            ->where('ketersediaan_kamar', 'tersedia')
            ->count();

        Kos::where('id_kos', $idKos)->update([
            'jumlah_kamar_tersedia' => $tersedia,
            'status_ketersediaan'   => $tersedia > 0 ? 'tersedia' : 'penuh',
        ]);
    }
}