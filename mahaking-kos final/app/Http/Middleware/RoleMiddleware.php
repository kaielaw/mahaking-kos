<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string $role): Response
    {
        // Belum login → simpan URL tujuan, redirect ke login
        if (!Auth::check()) {
            return redirect()->route('login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        $user = Auth::user();

        // Role tidak sesuai
        if ($user->role !== $role) {
            if ($user->role === 'pemilik') {
                return redirect()->route('owner.index')
                    ->with('error', 'Halaman ini hanya untuk pencari kos.');
            }
            return redirect()->route('dashboard')
                ->with('error', 'Halaman ini hanya untuk pemilik kos.');
        }

        return $next($request);
    }
}