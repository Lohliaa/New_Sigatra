<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BahanController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Form_PenilaianController;
use App\Http\Controllers\MOUController;
use App\Http\Controllers\PejabatController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\SKController;
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

    // DASHBOARD USER
    Route::get('/home', function () {
        return view('dashboard');
    })->name('dashboard');

    // DASHBOARD ADMIN
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // USER
    Route::get('users', [UserController::class, 'index'])
        ->name('users.index');

    Route::post('users', [UserController::class, 'store'])
        ->name('users.store');

    Route::get('users/{id}/edit', [UserController::class, 'edit'])
        ->name('users.edit');

    Route::put('users/{id}', [UserController::class, 'update'])
        ->name('users.update');

    Route::delete('users/{id}', [UserController::class, 'destroy'])
        ->name('users.destroy');

    // MOU
    Route::get('/mou/upload', [MOUController::class, 'upload'])->name('mou.upload');
    Route::post('/mou/upload', [MOUController::class, 'uploadProcess'])->name('mou.upload.process');
    Route::get('/export-mou', [MOUController::class, 'export'])->name('mou.export');
    Route::delete('/mou/destroy_all', [MOUController::class, 'destroy_all'])->name('mou.destroy_all');
    Route::resource('/mou', MOUController::class);

    // SK
    Route::get('/sk/upload', [SKController::class, 'upload'])->name('sk.upload');
    Route::post('/sk/upload', [SKController::class, 'uploadProcess'])->name('sk.upload.process');
    Route::get('/export-sk', [SKController::class, 'export'])->name('sk.export');
    Route::delete('/sk/destroy_all', [SKController::class, 'destroy_all'])->name('sk.destroy_all');
    Route::resource('/sk', SKController::class);

    // Bahan Penilaian Kinerja
    Route::resource('/bahan_penilaian', BahanController::class);

    // Form Penilaian Kinerja
    Route::resource('/form_penilaian', Form_PenilaianController::class);

    // PERIODE
    Route::resource('/periode', PeriodeController::class);

    // PEJABAT
    Route::resource('/pejabat', PejabatController::class);
});
