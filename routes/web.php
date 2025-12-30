<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Instansi\Controllers\InstansiController;
use App\Modules\Wali\Controllers\ProfileController;
use App\Modules\Auth\Controllers\AuthController;
// 1. IMPORT CONTROLLER PENDAFTARAN (Wajib ada)
use App\Modules\Pendaftaran\Controllers\PendaftaranController;

/*
|-------------------------------------------------------------------------- 
| PUBLIC PAGES (Bisa diakses siapa saja)
|-------------------------------------------------------------------------- 
*/
// Mengarah ke folder welcome/index.blade.php
Route::get('/', fn () => view('wali.welcome.index'))->name('wali.welcome');

/*
|-------------------------------------------------------------------------- 
| GUEST PAGES (Hanya untuk yang BELUM login)
|-------------------------------------------------------------------------- 
*/
Route::middleware(['guest'])->group(function () {
    // Login (DIPERBAIKI: Mengarah ke folder login/index.blade.php)
    Route::get('/wali/login', fn () => view('wali.login.index'))->name('wali.login');
    Route::post('/wali/login', [AuthController::class, 'login'])->name('login.process');

    // Register Wali (Mengarah ke folder register/index.blade.php)
    Route::get('/wali/register', fn () => view('wali.register.index'))->name('wali.register');
    Route::post('/wali/register', [AuthController::class, 'register'])->name('register.process');
});

/*
|-------------------------------------------------------------------------- 
| AUTHENTICATED PAGES (Hanya untuk yang SUDAH login)
|-------------------------------------------------------------------------- 
*/
Route::middleware(['auth'])->group(function () {
    
    // --- DASHBOARD & FITUR UTAMA ---
    Route::get('/wali/home', fn () => view('wali.home.index'))->name('wali.home');
    Route::get('/wali/harmofind', fn () => view('wali.harmofind.index'))->name('wali.harmofind');
    Route::get('/wali/harmoview', fn () => view('wali.harmoview.index'))->name('wali.harmoview');
    
    // Detail Instansi
    Route::get('/instansi/{id}', [InstansiController::class, 'show'])->name('wali.instansi.detail');

    // --- FITUR PENDAFTARAN (Route Tombol Daftar) ---
    // Route ini yang dipanggil saat tombol "Daftar Sekarang" diklik
    // Controller 'create' akan mengembalikan view 'daftar.blade.php'
    Route::get('/pendaftaran/daftar/{instansi_id}', [PendaftaranController::class, 'create'])
        ->name('pendaftaran.create');
    
    // Route untuk memproses data form saat diklik "Kirim"
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');

    // --- PROFILE WALI ---
    // Edit Profile -> Mengarah ke Controller, Controller harus return view('wali.edit.index')
    Route::get('/wali/profile/edit', [ProfileController::class, 'edit'])->name('wali.profile.edit'); 
    Route::put('/wali/profile/update', [ProfileController::class, 'update'])->name('wali.profile.update');

    // --- LOGOUT ---
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});