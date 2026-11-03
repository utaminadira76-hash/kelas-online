<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Registration;

// Halaman Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Grup Route Admin (Wajib Login)
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        $totalCourses = Course::count();
        $totalRegistrations = Registration::count();
        $recentRegistrations = Registration::with('course')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalCourses', 'totalRegistrations', 'recentRegistrations'));
    })->name('dashboard');

    // Kategori
    Route::resource('categories', \App\Http\Controllers\CategoryController::class);

});