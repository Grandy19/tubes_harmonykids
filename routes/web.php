<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| WALI - PUBLIC PAGES
|--------------------------------------------------------------------------
*/

// WELCOME
Route::get('/', function () {
    return view('wali.welcome');
})->name('wali.welcome');

// LOGIN & REGISTER
Route::get('/wali/login', function () {
    return view('wali.login');
})->name('wali.login');

Route::get('/wali/register', function () {
    return view('wali.register');
})->name('wali.register');

/*
|--------------------------------------------------------------------------
| WALI - AUTHENTICATED PAGES
|--------------------------------------------------------------------------
*/

    Route::get('/wali/home', function () {
        return view('wali.home');
    })->name('wali.home');

    // 🔴 INI YANG TADI ERROR
    Route::get('/wali/harmofind', function () {
        return view('wali.harmofind');
    })->name('wali.harmofind');

        Route::get('/wali/harmoview', function () {
        return view('wali.harmoview');
    })->name('wali.harmoview');

