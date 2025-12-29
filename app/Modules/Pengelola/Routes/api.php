<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Pengelola\Controllers\DashboardController;

Route::middleware(['auth:sanctum', 'role:pengelola'])
    ->prefix('pengelola')
    ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']);
    });
