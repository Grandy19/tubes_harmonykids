<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HarmoView\Controllers\HarmoViewController;


    Route::get('/harmoview/compare', [HarmoViewController::class, 'compare']);

