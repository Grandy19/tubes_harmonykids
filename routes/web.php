<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Instansi\Controllers\InstansiController;
use App\Http\Controllers\Wali\ProfileController;

/*
|-------------------------------------------------------------------------- 
| WALI - PUBLIC PAGES
|-------------------------------------------------------------------------- 
*/

Route::get('/', fn () => view('wali.welcome'))->name('wali.welcome');

Route::get('/wali/login', fn () => view('wali.login'))->name('wali.login');
Route::get('/wali/register', fn () => view('wali.register'))->name('wali.register');

/*
|-------------------------------------------------------------------------- 
| WALI - AUTHENTICATED PAGES
|-------------------------------------------------------------------------- 
*/

Route::get('/wali/home', fn () => view('wali.home'))->name('wali.home');

Route::get('/wali/harmofind', fn () => view('wali.harmofind'))
    ->name('wali.harmofind');

Route::get('/wali/harmoview', fn () => view('wali.harmoview'))->name('wali.harmoview');
    
Route::get('/instansi/{id}', [InstansiController::class, 'show'])->name('wali.instansi.detail');

    Route::get('/wali/profile/edit', function () {
        return view('wali.edit');
    })->name('wali.profile.edit');

        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
