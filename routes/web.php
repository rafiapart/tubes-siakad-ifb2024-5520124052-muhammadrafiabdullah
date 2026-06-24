<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Lihat jadwal: bisa diakses admin & mahasiswa (read-only untuk mahasiswa)
    Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal.index');

    // Khusus Admin: kelola semua data
    Route::middleware('role:admin')->group(function () {
        Route::resource('dosen', DosenController::class)->except(['show']);
        Route::resource('mahasiswa', MahasiswaController::class)->except(['show']);
        Route::resource('matakuliah', MataKuliahController::class)->except(['show']);
        Route::resource('jadwal', JadwalController::class)->except(['show', 'index']);
        Route::get('/krs-semua', [KrsController::class, 'all'])->name('krs.all');
    });

    // Khusus Mahasiswa: ambil & lihat KRS sendiri
    Route::middleware('role:mahasiswa')->group(function () {
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
        Route::get('/krs/export-pdf', [KrsController::class, 'exportPdf'])->name('krs.export-pdf');
    });
});
