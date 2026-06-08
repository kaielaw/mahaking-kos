<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlists = Wishlist::with(['kos.fotoKos', 'kos.lokasi'])
            ->where('id_user', Auth::user()->id_user)
            ->latest()
            ->get();

        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kos' => 'required|exists:kos,id_kos',
        ], [
            'id_kos.required' => 'ID kos tidak valid.',
            'id_kos.exists'   => 'Kos tidak ditemukan.',
        ]);

        // Cegah duplikat
        $sudahAda = Wishlist::where('id_user', Auth::user()->id_user)
            ->where('id_kos', $request->id_kos)
            ->exists();

        if ($sudahAda) {
            return back()->with('error', 'Kos sudah ada di wishlist kamu.');
        }

        // Generate id_favorit unik max 5 char
        do {
            $idFavorit = 'W' . strtoupper(Str::random(4));
        } while (Wishlist::where('id_favorit', $idFavorit)->exists());

        Wishlist::create([
            'id_favorit' => $idFavorit,
            'id_user'    => Auth::user()->id_user,
            'id_kos'     => $request->id_kos,
        ]);

        return back()->with('success', 'Kos berhasil ditambahkan ke wishlist!');
    }

    public function destroy($id)
    {
        $wishlist = Wishlist::where('id_favorit', $id)
            ->where('id_user', Auth::user()->id_user)
            ->firstOrFail();

        $wishlist->delete();

        return back()->with('success', 'Kos berhasil dihapus dari wishlist.');
    }
}