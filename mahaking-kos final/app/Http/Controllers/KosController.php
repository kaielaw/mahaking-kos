<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    // ─────────────────────────────────────────────
    //  INDEX — list + search + filter
    // ─────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Kos::with(['fotoKos', 'lokasi', 'detailFasilitas.fasilitas', 'review']);

        // Search
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('nama_kos', 'like', "%{$q}%")
                    ->orWhere('alamat', 'like', "%{$q}%")
                    ->orWhereHas('lokasi', fn($l) =>
                        $l->where('kecamatan', 'like', "%{$q}%")
                          ->orWhere('kota', 'like', "%{$q}%")
                    );
            });
        }

        // Filter jenis
        if ($request->filled('jenis')) {
            $query->where('jenis_kos', $request->jenis);
        }

        // Filter harga maksimum
        if ($request->filled('harga_max')) {
            $query->where('harga_min', '<=', (int) $request->harga_max);
        }

        // Filter fasilitas — cek apakah kos punya fasilitas yang dipilih
        if ($request->filled('fasilitas')) {
            $query->whereHas('detailFasilitas.fasilitas', function ($q) use ($request) {
                $q->where('nama_fasilitas', $request->fasilitas);
            });
        }

        // Sorting
        match ($request->sort) {
            'harga_asc'  => $query->orderBy('harga_min', 'asc'),
            'harga_desc' => $query->orderBy('harga_min', 'desc'),
            'rating'     => $query->orderByDesc('rating_rata2'),
            default      => $query->latest(),
        };

        $dataKos = $query->paginate(9)->withQueryString();

        // Hitung rating dari relasi review supaya selalu akurat
        foreach ($dataKos as $kos) {
            $kos->total_review = $kos->review->count();
            $kos->rating_rata2 = $kos->review->count()
                ? round($kos->review->avg('rating'), 1)
                : null;
        }

        return view('kos.index', compact('dataKos'));
    }

    // ─────────────────────────────────────────────
    //  SHOW — detail kos
    // ─────────────────────────────────────────────
    public function show($id)
    {
        $kos = Kos::with([
            'fotoKos',
            'lokasi',
            'detailFasilitas.fasilitas',
            'kamar',
            'review.user',
        ])->findOrFail($id);

        $kos->jumlah_kamar_tersedia = $kos->kamar
            ->where('ketersediaan_kamar', 'tersedia')
            ->count();

        $kos->rating_rata2 = $kos->review->count()
            ? round($kos->review->avg('rating'), 1)
            : null;
        $kos->total_review = $kos->review->count();

        // Load wishlist user kalau sudah login
        if (Auth::check()) {
            Auth::user()->load('wishlist');
        }

        return view('kos.detail', compact('kos'));
    }

    // ─────────────────────────────────────────────
    //  HELPER — rekomendasi untuk homepage
    // ─────────────────────────────────────────────
    public function getRekomendasi()
    {
        $dataKos = Kos::with(['fotoKos', 'lokasi', 'review'])
            ->where('status_ketersediaan', 'tersedia')
            ->latest()
            ->take(6)
            ->get();

        // Hitung rating & total_review dari relasi langsung
        // supaya selalu akurat walau kolom cached belum diupdate
        foreach ($dataKos as $kos) {
            $reviews = $kos->review;
            $kos->total_review = $reviews->count();
            $kos->rating_rata2 = $reviews->count()
                ? round($reviews->avg('rating'), 1)
                : null;
        }

        return $dataKos;
    }
}