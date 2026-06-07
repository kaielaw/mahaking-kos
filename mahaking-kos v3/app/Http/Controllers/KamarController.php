<?php

namespace App\Http\Controllers;

use App\Models\Kamar;
use Illuminate\Http\Request;

class KamarController extends Controller
{
    // ─────────────────────────────────────────────
    //  INDEX — List semua kamar (public, untuk referensi)
    //  GET /kamar
    // ─────────────────────────────────────────────
    public function index(Request $request)
    {
        $dataKamar = Kamar::with('kos')
            ->when($request->filled('id_kos'), function ($q) use ($request) {
                $q->where('id_kos', $request->id_kos);
            })
            ->when($request->filled('status'), function ($q) use ($request) {
                $q->where('status_kamar', $request->status);
            })
            ->paginate(12);

        return view('kamar.index', compact('dataKamar'));
    }
}