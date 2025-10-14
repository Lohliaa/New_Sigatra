<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\MOUController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('login.store');
Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store'])->name('register.store');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('dashboard', function () {
        return view('admin.dashboard');
    })->middleware('RoleMiddleware:admin')->name('admin.dashboard');

    // MOU
    Route::resource('/mou', MOUController::class);
    // Route::get('/mou/download/{id}', [MOUController::class, 'download'])->name('mou.download');
    Route::get('/mou/upload', [MOUController::class, 'upload'])->name('mou.upload');
    Route::post('/mou/upload', [MOUController::class, 'uploadProcess'])->name('mou.upload.process');
    Route::get('/export-mou', [MOUController::class, 'export'])->name('mou.export');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
