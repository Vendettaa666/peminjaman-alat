<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\PengembalianController;

Route::get('/', function () {
    return view('dashboard.auth.login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('kategori')->name('kategori.')->group(function () {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/create', [KategoriController::class, 'create'])->name('create');
        Route::post('/store', [KategoriController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [KategoriController::class, 'edit'])->name('edit');
        Route::get('/{id}', [KategoriController::class, 'show'])->name('show');
        Route::patch('/{id}', [KategoriController::class, 'update'])->name('update');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('alat')->name('alat.')->group(function () {
        Route::get('/', [AlatController::class, 'index'])->name('index');
        Route::get('/create', [AlatController::class, 'create'])->name('create');
        Route::post('/store', [AlatController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [AlatController::class, 'edit'])->name('edit');
        Route::get('/{id}', [AlatController::class, 'show'])->name('show');
        Route::patch('/{id}', [AlatController::class, 'update'])->name('update');
        Route::put('/{id}', [AlatController::class, 'update'])->name('update');
        Route::delete('/{id}', [AlatController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::patch('/{id}', [UserController::class, 'update'])->name('update');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])->name('index');
        Route::get('/create', [PeminjamanController::class, 'create'])->name('create');
        Route::get('/ajukan', [PeminjamanController::class, 'ajukan'])->name('ajukan');
        Route::post('/store', [PeminjamanController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PeminjamanController::class, 'edit'])->name('edit');
        Route::get('/{id}', [PeminjamanController::class, 'show'])->name('show');
        Route::patch('/{id}', [PeminjamanController::class, 'update'])->name('update');
        Route::put('/{id}', [PeminjamanController::class, 'update'])->name('update');
        Route::delete('/{id}', [PeminjamanController::class, 'destroy'])->name('destroy');
        Route::post('/{id}/approve', [PeminjamanController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [PeminjamanController::class, 'reject'])->name('reject');
    });

    Route::prefix('log_aktivitas')->name('log_aktivitas.')->group(function () {
        Route::get('/', [LogAktivitasController::class, 'index'])->name('index');
        Route::get('/create', [LogAktivitasController::class, 'create'])->name('create');
        Route::post('/store', [LogAktivitasController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [LogAktivitasController::class, 'edit'])->name('edit');
        Route::get('/{id}', [LogAktivitasController::class, 'show'])->name('show');
        Route::patch('/{id}', [LogAktivitasController::class, 'update'])->name('update');
        Route::put('/{id}', [LogAktivitasController::class, 'update'])->name('update');
        Route::delete('/{id}', [LogAktivitasController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('pengembalian')->name('pengembalian.')->group(function () {
        Route::get('/', [PengembalianController::class, 'index'])->name('index');
        Route::get('/create', [PengembalianController::class, 'create'])->name('create');
        Route::post('/store', [PengembalianController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [PengembalianController::class, 'edit'])->name('edit');
        Route::get('/{id}', [PengembalianController::class, 'show'])->name('show');
        Route::patch('/{id}', [PengembalianController::class, 'update'])->name('update');
        Route::put('/{id}', [PengembalianController::class, 'update'])->name('update');
        Route::delete('/{id}', [PengembalianController::class, 'destroy'])->name('destroy');
    });
});
