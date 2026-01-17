<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KarakterController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| DEBUG AUTH (OPSIONAL – HAPUS SETELAH SELESAI)
|--------------------------------------------------------------------------
*/
Route::get('/cek-role', function () {
    dd(
        auth()->check(),
        auth()->user()?->role,
        auth()->user()?->isAdmin()
    );
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
Auth::routes();

/*
|--------------------------------------------------------------------------
| HOME
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| KARAKTER – ADMIN (LOGIN REQUIRED)
|--------------------------------------------------------------------------
| ⚠️ HARUS DI ATAS ROUTE {id}
*/
Route::middleware('auth')->group(function () {

    Route::get('/karakter/create', [KarakterController::class, 'create'])
        ->name('karakter.create');

    Route::post('/karakter', [KarakterController::class, 'store'])
        ->name('karakter.store');

    Route::get('/karakter/{id}/edit', [KarakterController::class, 'edit'])
        ->name('karakter.edit');

    Route::put('/karakter/{id}', [KarakterController::class, 'update'])
        ->name('karakter.update');

    Route::delete('/karakter/{id}', [KarakterController::class, 'destroy'])
        ->name('karakter.destroy');
});

/*
|--------------------------------------------------------------------------
| KARAKTER – PUBLIK
|--------------------------------------------------------------------------
*/
Route::get('/karakter', [KarakterController::class, 'index'])
    ->name('karakter.index');

Route::get('/karakter/{id}', [KarakterController::class, 'show'])
    ->name('karakter.show');

