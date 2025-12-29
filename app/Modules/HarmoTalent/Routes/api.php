<?php

use Illuminate\Support\Facades\Route;
use App\Modules\HarmoTalent\Controllers\HarmoTalentController;

Route::get('/harmotalent', [HarmoTalentController::class, 'index']);
