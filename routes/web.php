<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\LandingController;
use Illuminate\Support\Facades\Route;
use App\Models\Course;
use App\Models\Registration;

// --- RUTE LANDING PAGE (Bisa diakses tanpa login) ---
Route::get('/', [LandingController::class, 'index'])->name('landing.index');
Route::get('/kelas/{course:slug}', [LandingController::class, 'show'])->name('landing.show');
Route::post('/kelas/{course:slug}/daftar', [LandingController::class, 'register'])->name('landing.register');

// --- RUTE AUTENTIKASI ---
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- RUTE ADMIN (Wajib Login) ---
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    
    // Dashboard
    Route::get('/dashboard', function () {
        $totalCourses = Course::count();
        $totalRegistrations = Registration::count();
        $recentRegistrations = Registration::with('course')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalCourses', 'totalRegistrations', 'recentRegistrations'));
    })->name('dashboard');

    // Kategori
    Route::resource('categories', CategoryController::class);

    // Kelas
    Route::resource('courses', CourseController::class);

    // Pendaftar
    Route::get('registrations', [RegistrationController::class, 'index'])->name('registrations.index');
    Route::put('registrations/{registration}/status', [RegistrationController::class, 'updateStatus'])->name('registrations.update-status');
    
    // RUTE EKSPOR CSV (Dipindahkan ke dalam grup admin)
    Route::get('registrations/export/csv', [RegistrationController::class, 'export'])->name('registrations.export');

});