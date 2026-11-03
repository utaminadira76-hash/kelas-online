<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grup Route Admin (Wajib Login)
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    // Nanti kita isi dashboard di sini
    Route::get('/dashboard', function () {
        return 'Halaman Dashboard Admin (Segera dibuat)';
    })->name('dashboard');
});