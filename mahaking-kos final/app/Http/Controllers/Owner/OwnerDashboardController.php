<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Kos;
use App\Models\Kamar;
use Illuminate\Support\Facades\Auth;

class OwnerDashboardController extends Controller
{
    // ─────────────────────────────────────────────
    //  INDEX — Dashboard owner/pemilik kos
    //  GET /owner
    // ─────────────────────────────────────────────
    public function index()
    {
        $user     = Auth::user();
        $pemilik  = $user->pemilikKos;

        // Kalau belum ada data pemilik, tampilkan dashboard kosong
        if (!$pemilik) {
            return view('owner.index', [
                'dataKos'       => collect(),
                'totalKos'      => 0,
                'totalKamar'    => 0,
                'kamarTersedia' => 0,
            ]);
        }

        // Ambil semua kos milik pemilik ini
        $dataKos = Kos::with(['fotoKos', 'lokasi'])
            ->where('id_pemilik', $pemilik->id_pemilik)
            ->withCount('review as total_review')
            ->latest()
            ->get();

        // Statistik
        $totalKos      = $dataKos->count();
        $totalKamar    = $dataKos->sum('jumlah_kamar');
        $kamarTersedia = Kamar::whereHas('kos', function ($q) use ($pemilik) {
                $q->where('id_pemilik', $pemilik->id_pemilik);
            })
            ->where('ketersediaan_kamar', 'tersedia')
            ->count();

        return view('owner.index', compact(
            'dataKos',
            'totalKos',
            'totalKamar',
            'kamarTersedia'
        ));
    }
}