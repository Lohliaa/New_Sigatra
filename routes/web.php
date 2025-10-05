<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// ======================
// User Routes
// ======================

// Halaman Welcome
Route::get('/', function () {
    return view('welcome');
});

// Dashboard User
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile User
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes default Laravel Breeze/Fortify
require __DIR__.'/auth.php';


// ======================
// Admin Routes
// ======================
Route::prefix('admin')->group(function () {

    // Kalau belum login admin
    Route::middleware('guest:admin')->group(function () {
        Route::get('register', [RegisteredUserController::class, 'create'])->name('admin.register');
        Route::post('register', [RegisteredUserController::class, 'store']);

        Route::get('login', [LoginController::class, 'create'])->name('admin.login');
        Route::post('login', [LoginController::class, 'store']);
    });

    // Kalau sudah login admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::post('logout', [LoginController::class, 'destroy'])->name('admin.logout');
    });
});
