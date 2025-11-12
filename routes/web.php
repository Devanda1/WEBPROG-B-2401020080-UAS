<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KarakterController;

// Halaman Utama
Route::get('/', function () {
    return view('home');
});

// Halaman Daftar Karakter
Route::get('/karakter', [KarakterController::class, 'index'])->name('karakter');

// Halaman Detail Karakter
Route::get('/karakter/{id}', [KarakterController::class, 'show'])->name('karakter.show');
