<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KosController;
use App\Http\Controllers\KamarController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Owner\OwnerDashboardController;
use App\Http\Controllers\Owner\OwnerKosController;
use App\Http\Controllers\Owner\OwnerKamarController;
use App\Http\Controllers\Owner\OwnerProfileController;

// ══════════════════════════════════════════════════════
//  PUBLIC
// ══════════════════════════════════════════════════════

Route::get('/', function () {
    $dataKos = app(KosController::class)->getRekomendasi();
    // Load wishlist user kalau sudah login (untuk cek status di card homepage)
    if (auth()->check()) {
        auth()->user()->load('wishlist');
    }
    return view('homepage.index', compact('dataKos'));
})->name('home');

Route::get('/kos',      [KosController::class, 'index'])->name('kos.index');
Route::get('/kos/{id}', [KosController::class, 'show'])->name('kos.show');

// ══════════════════════════════════════════════════════
//  GUEST ONLY (redirect kalau sudah login)
// ══════════════════════════════════════════════════════

Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register'])->name('register.post');
});

// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ══════════════════════════════════════════════════════
//  PENYEWA (auth + role:penyewa)
// ══════════════════════════════════════════════════════

Route::middleware(['auth', 'role:penyewa'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Wishlist
    Route::get('/wishlist',         [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist',        [WishlistController::class, 'store'])->name('wishlist.store');
    Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

    // Review
    Route::get('/review',          [ReviewController::class, 'index'])->name('review.index');
    Route::post('/review',         [ReviewController::class, 'store'])->name('review.store');
    Route::delete('/review/{id}',  [ReviewController::class, 'destroy'])->name('review.destroy');

    // Profile
    Route::get('/profile',  [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile',  [ProfileController::class, 'update'])->name('profile.update');
});

// ══════════════════════════════════════════════════════
//  OWNER (auth + role:pemilik)
// ══════════════════════════════════════════════════════

Route::middleware(['auth', 'role:pemilik'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

    // Dashboard
    Route::get('/', [OwnerDashboardController::class, 'index'])->name('index');

    // Data Kos
    Route::get('/kos',              [OwnerKosController::class, 'index'])->name('kos.index');
    Route::get('/kos/create',       [OwnerKosController::class, 'create'])->name('kos.create');
    Route::post('/kos',             [OwnerKosController::class, 'store'])->name('kos.store');
    Route::get('/kos/{id}/edit',    [OwnerKosController::class, 'edit'])->name('kos.edit');
    Route::put('/kos/{id}',         [OwnerKosController::class, 'update'])->name('kos.update');
    Route::delete('/kos/{id}',      [OwnerKosController::class, 'destroy'])->name('kos.destroy');

    // Data Kamar
    Route::get('/kamar',            [OwnerKamarController::class, 'index'])->name('kamar.index');
    Route::get('/kamar/create',     [OwnerKamarController::class, 'create'])->name('kamar.create');
    Route::post('/kamar',           [OwnerKamarController::class, 'store'])->name('kamar.store');
    Route::get('/kamar/{id}/edit',  [OwnerKamarController::class, 'edit'])->name('kamar.edit');
    Route::put('/kamar/{id}',       [OwnerKamarController::class, 'update'])->name('kamar.update');
    Route::delete('/kamar/{id}',    [OwnerKamarController::class, 'destroy'])->name('kamar.destroy');

    // Profile Owner
    Route::get('/profile',  [OwnerProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile',  [OwnerProfileController::class, 'update'])->name('profile.update');
});

// ══════════════════════════════════════════════════════
//  FALLBACK
// ══════════════════════════════════════════════════════

Route::fallback(fn() => redirect()->route('home'));