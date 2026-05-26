<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard.index');
});

use App\Http\Controllers\KosController;
Route::get('/kos', [KosController::class, 'index']);

use App\Http\Controllers\KamarController;
Route::get('/kamar', [KamarController::class, 'index']);