<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Forum\Controllers\ForumController;

// WALI
Route::middleware(['auth:sanctum', 'role:wali'])->group(function () {
    Route::post('/forum', [ForumController::class, 'store']);
    Route::get('/forum/mine', [ForumController::class, 'mine']);
});

// PUBLIC
Route::get('/forum', [ForumController::class, 'index']);

// ADMIN
Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::delete('/forum/{id}', [ForumController::class, 'destroy']);
});