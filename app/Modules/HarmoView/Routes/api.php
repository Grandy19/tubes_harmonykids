<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HarmoView\Controllers\HarmoViewController;

Route::middleware(['auth:sanctum', 'role:wali'])->group(function () {
    Route::get('/harmoview', [HarmoViewController::class, 'compare']);
});
