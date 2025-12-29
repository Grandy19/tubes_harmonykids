<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Instansi\Controllers\InstansiController;
use App\Modules\Instansi\Controllers\AdminInstansiController;

// =====================
// PUBLIC / WALI
// =====================
Route::prefix('instansi')->group(function () {

    Route::get('/', [InstansiController::class, 'index']);
    Route::get('/{id}', [InstansiController::class, 'show']);

    // =====================
    // PENGELOLA
    // =====================
    Route::middleware(['auth:sanctum', 'role:pengelola'])->group(function () {
        Route::post('/', [InstansiController::class, 'store']);
        Route::put('/', [InstansiController::class, 'update']);
        Route::post('/gallery', [InstansiController::class, 'uploadGallery']);
    });
});

// =====================
// ADMIN (GLOBAL SCOPE)
// =====================
Route::middleware(['auth:sanctum', 'role:admin'])
    ->prefix('admin/instansi')
    ->group(function () {

        Route::get('/pending', [AdminInstansiController::class, 'pending']);
        Route::put('/{id}/approve', [AdminInstansiController::class, 'approve']);
        Route::put('/{id}/reject', [AdminInstansiController::class, 'reject']);
    });
