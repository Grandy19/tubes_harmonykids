<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pendaftaran\Controllers\PendaftaranController;
use App\Modules\Pendaftaran\Controllers\PengelolaPendaftaranController;

    // WALI
    Route::middleware(['auth:sanctum', 'role:wali'])->group(function () {
        Route::post('/pendaftaran', [PendaftaranController::class, 'store']);
    });

    // PENGELOLA
    Route::middleware(['auth:sanctum', 'role:pengelola'])->group(function () {
        Route::get('/pendaftaran', [PendaftaranController::class, 'index']);
        Route::put('/pendaftaran/{id}/approve', [PendaftaranController::class, 'approve']);
        Route::put('/pendaftaran/{id}/reject', [PendaftaranController::class, 'reject']);
    });
