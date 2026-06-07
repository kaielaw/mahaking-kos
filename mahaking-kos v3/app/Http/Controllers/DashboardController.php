<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // ─────────────────────────────────────────────
    //  INDEX — Dashboard penyewa
    //  GET /dashboard
    // ─────────────────────────────────────────────
    public function index()
    {
        $user = Auth::user();

        $totalWishlist = Wishlist::where('id_user', $user->id_user)->count();
        $totalReview   = Review::where('id_user', $user->id_user)->count();

        // 3 wishlist terbaru
        $wishlistTerbaru = Wishlist::with(['kos.fotoKos', 'kos.lokasi'])
            ->where('id_user', $user->id_user)
            ->latest()
            ->take(3)
            ->get();

        // 3 review terbaru
        $reviewTerbaru = Review::with('kos')
            ->where('id_user', $user->id_user)
            ->latest()
            ->take(3)
            ->get();

        return view('dashboard', compact(
            'user',
            'totalWishlist',
            'totalReview',
            'wishlistTerbaru',
            'reviewTerbaru'
        ));
    }
}