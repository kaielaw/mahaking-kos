<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\PemilikKos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    // ─────────────────────────────────────────────
    //  SHOW LOGIN FORM
    // ─────────────────────────────────────────────
    public function showLogin()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.login');
    }

    // ─────────────────────────────────────────────
    //  PROSES LOGIN
    // ─────────────────────────────────────────────
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()
                ->withInput($request->only('email'))
                ->with('error', 'Email atau password salah. Silakan coba lagi.');
        }

        Auth::login($user, $request->boolean('remember'));
        $request->session()->regenerate();

        return $this->redirectByRole($user);
    }

    // ─────────────────────────────────────────────
    //  SHOW REGISTER FORM
    // ─────────────────────────────────────────────
    public function showRegister()
    {
        if (Auth::check()) {
            return $this->redirectByRole(Auth::user());
        }
        return view('auth.register');
    }

    // ─────────────────────────────────────────────
    //  PROSES REGISTER
    // ─────────────────────────────────────────────
    public function register(Request $request)
    {
        $request->validate([
            'nama_depan'            => 'required|string|max:50',
            'nama_belakang'         => 'nullable|string|max:50',
            'email'                 => 'required|email|max:50|unique:user,email',
            'no_hp'                 => 'nullable|string|max:15',
            'role'                  => 'required|in:penyewa,pemilik',
            'password'              => 'required|string|min:6',
            'password_confirmation' => 'required|string|same:password',
        ], [
            'nama_depan.required'            => 'Nama depan wajib diisi.',
            'email.required'                 => 'Email wajib diisi.',
            'email.unique'                   => 'Email sudah terdaftar, silakan login.',
            'role.required'                  => 'Pilih peran akun kamu.',
            'password.required'              => 'Password wajib diisi.',
            'password.min'                   => 'Password minimal 6 karakter.',
            'password_confirmation.required' => 'Konfirmasi password wajib diisi.',
            'password_confirmation.same'     => 'Konfirmasi password tidak cocok.',
        ]);

        // Generate ID yang tidak bentrok
        do { $idUser = 'U' . strtoupper(Str::random(4)); }
        while (User::where('id_user', $idUser)->exists());

        $user = User::create([
            'id_user'       => $idUser,
            'nama_depan'    => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang ?? '',
            'email'         => $request->email,
            'nomor_hp'      => $request->no_hp ?? '',
            'foto_profil'   => 'default.jpg',
            'role'          => $request->role,
            'password'      => Hash::make($request->password),
        ]);

        if ($user->role === 'pemilik') {
            do { $idPemilik = 'P' . strtoupper(Str::random(4)); }
            while (PemilikKos::where('id_pemilik', $idPemilik)->exists());

            PemilikKos::create([
                'id_pemilik'        => $idPemilik,
                'id_user'           => $user->id_user,
                'nama_depan'        => $user->nama_depan,
                'nama_belakang'     => $user->nama_belakang,
                'nama_bank'         => '-',
                'nomor_rekening'    => '-',
                'nama_rekening'     => trim($user->nama_depan . ' ' . $user->nama_belakang),
                'no_hp'             => $user->nomor_hp,
                'alamat'            => '-',
                'verifikasi_status' => 'pending',
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return $this->redirectByRole($user)
            ->with('success', 'Akun berhasil dibuat! Selamat datang, ' . $user->nama_depan . '.');
    }

    // ─────────────────────────────────────────────
    //  LOGOUT
    // ─────────────────────────────────────────────
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')
            ->with('success', 'Kamu telah keluar dari akun.');
    }

    // ─────────────────────────────────────────────
    //  PRIVATE — redirect sesuai role
    // ─────────────────────────────────────────────
    private function redirectByRole(User $user)
    {
        if ($user->role === 'pemilik') {
            return redirect()->route('owner.index');
        }
        // Penyewa → homepage (sudah ada navbar logged-in state)
        return redirect()->intended(route('home'));
    }
}