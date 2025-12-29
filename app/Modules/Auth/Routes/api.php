<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Auth\Controllers\AuthController;

Route::prefix('auth')->group(function () {

    // WALI
    Route::post('/register', [AuthController::class, 'register']);

    // LOGIN (SEMUA ROLE)
    Route::post('/login', [AuthController::class, 'login']);

    // PENGELOLA
    Route::post('/register-pengelola', [AuthController::class, 'registerPengelola']);

});
