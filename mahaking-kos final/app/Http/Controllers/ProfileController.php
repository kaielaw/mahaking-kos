<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.user', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_depan'    => 'required|string|max:50',
            'nama_belakang' => 'nullable|string|max:50',
            'nomor_hp'      => 'nullable|string|max:15',
            'foto_profil'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ], [
            'nama_depan.required' => 'Nama depan wajib diisi.',
            'foto_profil.image'   => 'File harus berupa gambar.',
            'foto_profil.max'     => 'Ukuran foto maksimal 2MB.',
        ]);

        $data = [
            'nama_depan'    => $request->nama_depan,
            // Kirim string kosong '' bukan null — migration NOT NULL
            'nama_belakang' => $request->nama_belakang ?? '',
            'nomor_hp'      => $request->nomor_hp ?? '',
        ];

        if ($request->hasFile('foto_profil')) {
            // Hapus foto lama kalau bukan default
            if ($user->foto_profil
                && $user->foto_profil !== 'default.jpg'
                && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            // Simpan foto baru
            $path = $request->file('foto_profil')->store('profil', 'public');
            $data['foto_profil'] = $path;
        }

        $user->update($data);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}