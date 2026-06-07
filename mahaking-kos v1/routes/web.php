<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage.index');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

use App\Http\Controllers\KosController;
Route::get('/kos', [KosController::class, 'index']);
Route::get('/kos/{id}', [KosController::class, 'show']);

use App\Http\Controllers\KamarController;
Route::get('/kamar', [KamarController::class, 'index']);