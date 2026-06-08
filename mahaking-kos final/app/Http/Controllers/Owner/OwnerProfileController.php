<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\PemilikKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class OwnerProfileController extends Controller
{
    public function show()
    {
        $user    = Auth::user();
        $pemilik = $user->pemilikKos;
        return view('profile.pemilik', compact('user', 'pemilik'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'nama_depan'     => 'required|string|max:50',
            'nama_belakang'  => 'nullable|string|max:50',
            'no_hp'          => 'nullable|string|max:15',
            'foto_profil'    => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama_bank'      => 'nullable|string|max:50',
            'nomor_rekening' => 'nullable|string|max:50',
            'nama_rekening'  => 'nullable|string|max:100',
        ], [
            'nama_depan.required' => 'Nama pemilik wajib diisi.',
            'foto_profil.image'   => 'File harus berupa gambar.',
            'foto_profil.max'     => 'Ukuran foto maksimal 2MB.',
        ]);

        // Update tabel user
        $userData = [
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang ?? '',
            'nomor_hp'      => $request->no_hp ?? '',
        ];

        if ($request->hasFile('foto_profil')) {
            if ($user->foto_profil
                && $user->foto_profil !== 'default.jpg'
                && Storage::disk('public')->exists($user->foto_profil)) {
                Storage::disk('public')->delete($user->foto_profil);
            }
            $path = $request->file('foto_profil')->store('profil', 'public');
            $userData['foto_profil'] = $path;
        }

        $user->update($userData);

        // Cek apakah sudah ada record pemilik_kos
        $pemilik = $user->pemilikKos;

        if ($pemilik) {
            // Update yang sudah ada
            $pemilik->update([
                'nama_depan'     => $request->nama_depan,
                'nama_belakang'  => $request->nama_belakang ?? '',
                'no_hp'          => $request->no_hp ?? $pemilik->no_hp,
                'nama_bank'      => $request->nama_bank ?? $pemilik->nama_bank,
                'nomor_rekening' => $request->nomor_rekening ?? $pemilik->nomor_rekening,
                'nama_rekening'  => $request->nama_rekening ?? $pemilik->nama_rekening,
            ]);
        } else {
            // Buat baru dengan semua kolom NOT NULL diisi
            do {
                $idPemilik = 'P' . strtoupper(Str::random(4));
            } while (PemilikKos::where('id_pemilik', $idPemilik)->exists());

            PemilikKos::create([
                'id_pemilik'        => $idPemilik,
                'id_user'           => $user->id_user,
                'nama_depan'        => $request->nama_depan,
                'nama_belakang'     => $request->nama_belakang ?? '',
                'no_hp'             => $request->no_hp ?? '-',
                'alamat'            => '-',
                'nama_bank'         => $request->nama_bank ?? '-',
                'nomor_rekening'    => $request->nomor_rekening ?? '-',
                'nama_rekening'     => $request->nama_rekening ?? $request->nama_depan,
                'verifikasi_status' => 'pending',
            ]);
        }

        return back()->with('success', 'Profil berhasil disimpan!');
    }
}