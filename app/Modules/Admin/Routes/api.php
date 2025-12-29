<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Admin\Controllers\AdminController;

Route::middleware(['auth:sanctum', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('/users', [AdminController::class, 'users']);
    Route::delete('/instansi/{id}', [AdminController::class, 'deleteInstansi']);

});
