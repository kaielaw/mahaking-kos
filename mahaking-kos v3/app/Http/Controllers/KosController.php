<?php

namespace App\Http\Controllers;

use App\Models\Kos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosController extends Controller
{
    // ─────────────────────────────────────────────
    //  INDEX — List + search + filter
    // ─────────────────────────────────────────────
    public function index(Request $request)
    {
        $query = Kos::with(['fotoKos', 'lokasi']);

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

        if ($request->filled('jenis')) {
            $query->where('jenis_kos', $request->jenis);
        }

        if ($request->filled('harga_max')) {
            $query->where('harga_min', '<=', (int) $request->harga_max);
        }

        match ($request->sort) {
            'harga_asc'  => $query->orderBy('harga_min', 'asc'),
            'harga_desc' => $query->orderBy('harga_min', 'desc'),
            'rating'     => $query->orderByDesc('rating_rata2'),
            default      => $query->latest(),
        };

        $dataKos = $query->paginate(9)->withQueryString();

        return view('kos.index', compact('dataKos'));
    }

    // ─────────────────────────────────────────────
    //  SHOW — Detail kos + load wishlist user
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

        // Hitung kamar tersedia
        $kos->jumlah_kamar_tersedia = $kos->kamar
            ->where('ketersediaan_kamar', 'tersedia')
            ->count();

        // Hitung rating dari relasi
        $kos->rating_rata2 = $kos->review->count()
            ? round($kos->review->avg('rating'), 1)
            : null;
        $kos->total_review = $kos->review->count();

        // Load wishlist user kalau sudah login (untuk cek status tombol)
        if (Auth::check()) {
            Auth::user()->load('wishlist');
        }

        return view('kos.detail', compact('kos'));
    }

    // ─────────────────────────────────────────────
    //  HELPER — Rekomendasi untuk homepage
    // ─────────────────────────────────────────────
    public function getRekomendasi()
    {
        return Kos::with(['fotoKos', 'lokasi'])
            ->where('status_ketersediaan', 'tersedia')
            ->latest()
            ->take(6)
            ->get();
    }
}