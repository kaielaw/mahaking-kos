<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kamar;
use App\Models\Kos;
use App\Models\Fasilitas;
use App\Models\DetailFasilitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class OwnerKamarController extends Controller
{
    private function getPemilikId(): string
    {
        $pemilik = Auth::user()->pemilikKos;
        if (!$pemilik) abort(403, 'Data pemilik tidak ditemukan.');
        return $pemilik->id_pemilik;
    }

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
        $dataKamar = Kamar::with('kos')
            ->whereHas('kos', fn($q) => $q->where('id_pemilik', $this->getPemilikId()))
            ->latest()
            ->get();

        return view('kamar.index', compact('dataKamar'));
    }

    // CREATE
    public function create()
    {
        $dataKos = Kos::where('id_pemilik', $this->getPemilikId())
            ->orderBy('nama_kos')
            ->get(['id_kos', 'nama_kos']);

        return view('kamar.create', compact('dataKos'));
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'id_kos'             => 'required|exists:kos,id_kos',
            'nomor_kamar'        => 'nullable|string|max:20',
            'ukuran'             => 'nullable|string|max:50',
            'tipe_kamar'         => 'nullable|string|max:20',
            'harga_per_bulan'    => 'required|numeric|min:0',
            'ketersediaan_kamar' => 'required|in:tersedia,terisi',
            'fasilitas'          => 'nullable|array',
        ], [
            'id_kos.required'             => 'Pilih kos terlebih dahulu.',
            'harga_per_bulan.required'    => 'Harga per bulan wajib diisi.',
            'ketersediaan_kamar.required' => 'Status kamar wajib dipilih.',
        ]);

        // Pastikan kos milik owner ini
        Kos::where('id_kos', $request->id_kos)
            ->where('id_pemilik', $this->getPemilikId())
            ->firstOrFail();

        // Simpan kamar
        $idKamar = $this->uniqueId('K', 'kamar', 'id_kamar');
        $kamar = new Kamar();
        $kamar->id_kamar           = $idKamar;
        $kamar->id_kos             = $request->id_kos;
        $kamar->nomor_kamar        = (int) ($request->nomor_kamar ?? 1);
        $kamar->ukuran             = $request->ukuran ?? '-';
        $kamar->tipe_kamar         = $request->tipe_kamar ?? '-';
        $kamar->harga_per_bulan    = $request->harga_per_bulan;
        $kamar->harga_per_tahun    = $request->harga_per_bulan * 12;
        $kamar->ketersediaan_kamar = $request->ketersediaan_kamar;
        $kamar->save();

        // Simpan fasilitas
        if ($request->filled('fasilitas')) {
            foreach ($request->fasilitas as $namaFas) {
                $fas = Fasilitas::where('nama_fasilitas', $namaFas)->first();
                if (!$fas) {
                    $fas = new Fasilitas();
                    $fas->id_fasilitas   = $this->uniqueId('F', 'fasilitas', 'id_fasilitas');
                    $fas->nama_fasilitas = $namaFas;
                    $fas->save();
                }
                // Cek apakah detail fasilitas sudah ada untuk kos ini
                $exists = DetailFasilitas::where('id_kos', $request->id_kos)
                    ->where('id_fasilitas', $fas->id_fasilitas)
                    ->exists();
                if (!$exists) {
                    $df = new DetailFasilitas();
                    $df->id_detail_fasilitas = $this->uniqueId('D', 'detail_fasilitas', 'id_detail_fasilitas');
                    $df->id_kos              = $request->id_kos;
                    $df->id_fasilitas        = $fas->id_fasilitas;
                    $df->keterangan          = $namaFas;
                    $df->save();
                }
            }
        }

        // Update jumlah_kamar_tersedia di kos
        $this->syncKamarTersedia($request->id_kos);

        return redirect()->route('owner.kamar.index')
            ->with('success', 'Kamar berhasil ditambahkan!');
    }

    // EDIT
    public function edit($id)
    {
        $kamar = Kamar::with('kos')
            ->whereHas('kos', fn($q) => $q->where('id_pemilik', $this->getPemilikId()))
            ->findOrFail($id);

        $dataKos = Kos::where('id_pemilik', $this->getPemilikId())
            ->orderBy('nama_kos')
            ->get(['id_kos', 'nama_kos']);

        return view('kamar.edit', compact('kamar', 'dataKos'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $kamar = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $this->getPemilikId()))
            ->findOrFail($id);

        $request->validate([
            'nomor_kamar'        => 'nullable|string|max:20',
            'ukuran'             => 'nullable|string|max:50',
            'tipe_kamar'         => 'nullable|string|max:20',
            'harga_per_bulan'    => 'required|numeric|min:0',
            'ketersediaan_kamar' => 'required|in:tersedia,terisi',
        ], [
            'harga_per_bulan.required'    => 'Harga per bulan wajib diisi.',
            'ketersediaan_kamar.required' => 'Status kamar wajib dipilih.',
        ]);

        $kamar->nomor_kamar        = (int) ($request->nomor_kamar ?? $kamar->nomor_kamar);
        $kamar->ukuran             = $request->ukuran ?? $kamar->ukuran;
        $kamar->tipe_kamar         = $request->tipe_kamar ?? $kamar->tipe_kamar;
        $kamar->harga_per_bulan    = $request->harga_per_bulan;
        $kamar->harga_per_tahun    = $request->harga_per_bulan * 12;
        $kamar->ketersediaan_kamar = $request->ketersediaan_kamar;
        $kamar->save();

        $this->syncKamarTersedia($kamar->id_kos);

        return redirect()->route('owner.kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui!');
    }

    // DESTROY
    public function destroy($id)
    {
        $kamar = Kamar::whereHas('kos', fn($q) => $q->where('id_pemilik', $this->getPemilikId()))
            ->findOrFail($id);

        $idKos = $kamar->id_kos;
        $kamar->delete();
        $this->syncKamarTersedia($idKos);

        return redirect()->route('owner.kamar.index')
            ->with('success', 'Kamar berhasil dihapus.');
    }

    private function syncKamarTersedia(string $idKos): void
    {
        $tersedia = Kamar::where('id_kos', $idKos)
            ->where('ketersediaan_kamar', 'tersedia')
            ->count();
        $hargaMin = Kamar::where('id_kos', $idKos)->min('harga_per_bulan');

        Kos::where('id_kos', $idKos)->update([
            'jumlah_kamar_tersedia' => $tersedia,
            'status_ketersediaan'   => $tersedia > 0 ? 'tersedia' : 'penuh',
            'harga_min'             => $hargaMin ?? 0,
        ]);
    }
}