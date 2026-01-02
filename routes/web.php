<?php

use Illuminate\Support\Facades\Route;
use App\Modules\Instansi\Controllers\InstansiController;
use App\Modules\Wali\Controllers\ProfileController;
use App\Modules\Auth\Controllers\AuthController;
use App\Modules\Pendaftaran\Controllers\PendaftaranController;
use App\Modules\HarmoTalent\Controllers\HarmoTalentController;
use App\Modules\Wali\Controllers\SettingsController;
use App\Modules\Forum\Controllers\ForumController;
use App\Modules\Wali\Controllers\LikedController;
use App\Modules\Pengelola\Controllers\InstansiPengelolaController;
use App\Modules\Pendaftaran\Controllers\PengelolaPendaftaranController;

/*
|--------------------------------------------------------------------------
| PUBLIC PAGES
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('role-select'))->name('role.select');

Route::get('/wali/welcome', fn () => view('wali.welcome.index'))
    ->name('wali.welcome');

/*
|--------------------------------------------------------------------------
| GUEST (WALI & PENGELOLA)
|--------------------------------------------------------------------------
*/
Route::middleware(['guest'])->group(function () {

    Route::get('/wali/login', fn () => view('wali.login.index'))->name('wali.login');
    Route::post('/wali/login', [AuthController::class, 'login'])->name('login.process');

    Route::get('/wali/register', fn () => view('wali.register.index'))->name('wali.register');
    Route::post('/wali/register', [AuthController::class, 'register'])->name('register.process');

    Route::get('/pengelola/login', fn () => view('pengelola.auth.login'))->name('pengelola.login');
    Route::post('/pengelola/login', [AuthController::class, 'login'])->name('pengelola.login.process');

    Route::get('/pengelola/register', fn () => view('pengelola.auth.register'))->name('pengelola.register');
    Route::post('/pengelola/register', [AuthController::class, 'registerPengelola'])
        ->name('pengelola.register.process');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED WALI
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    Route::get('/wali/home', fn () => view('wali.home.index'))->name('wali.home');
    Route::get('/wali/harmofind', fn () => view('wali.harmofind.index'))->name('wali.harmofind');
    Route::get('/wali/harmoview', fn () => view('wali.harmoview.index'))->name('wali.harmoview');

    Route::get('/wali/harmotalent', [HarmoTalentController::class, 'index'])->name('wali.harmotalent');
    Route::get('/wali/harmotalent/result', [HarmoTalentController::class, 'result'])->name('harmotalent.result');

    Route::get('/wali/harmotalk', [ForumController::class, 'index'])->name('wali.harmotalk');
    Route::get('/wali/harmotalk/create', [ForumController::class, 'create'])->name('wali.harmotalk.create');
    Route::post('/wali/harmotalk', [ForumController::class, 'store'])->name('wali.harmotalk.store');

    Route::post('/wali/harmotalk/{id}/like', [ForumController::class, 'like'])->name('wali.harmotalk.like');
    Route::get('/wali/harmotalk/{id}/comments', [ForumController::class, 'getComments']);
    Route::post('/wali/harmotalk/{id}/comment', [ForumController::class, 'storeComment'])->name('wali.harmotalk.comment');

    Route::get('/instansi/{id}', [InstansiController::class, 'show'])->name('wali.instansi.detail');

    Route::get('/pendaftaran/daftar/{instansi_id}', [PendaftaranController::class, 'create'])
        ->name('pendaftaran.create');
    Route::post('/pendaftaran/store', [PendaftaranController::class, 'store'])
        ->name('pendaftaran.store');

    Route::get('/wali/profile/edit', [ProfileController::class, 'edit'])->name('wali.profile.edit');
    Route::put('/wali/profile/update', [ProfileController::class, 'update'])->name('wali.profile.update');

    Route::get('/wali/settings', [SettingsController::class, 'index'])->name('wali.settings');
    Route::put('/wali/settings/password', [SettingsController::class, 'updatePassword'])->name('wali.settings.password');

    /*
    |--------------------------------------------------------------------------
    | DISUKAI (✔ DIPERBAIKI DI SINI SAJA)
    |--------------------------------------------------------------------------
    */

    // Halaman daftar instansi yang di-like
    Route::get('/disukai', [LikedController::class, 'index'])
        ->name('wali.liked');

    Route::post('/instansi/{id}/like', [LikedController::class, 'toggle'])
        ->name('wali.instansi.like');

    /*
    |--------------------------------------------------------------------------
    | NOTIFIKASI
    |--------------------------------------------------------------------------
    */
    Route::get('/wali/notifikasi',
        [\App\Modules\Wali\Controllers\NotifikasiController::class, 'index']
    )->name('wali.notifikasi');

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

/*
|--------------------------------------------------------------------------
| AUTHENTICATED PENGELOLA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:pengelola'])
    ->prefix('pengelola')
    ->group(function () {

        Route::get('/dashboard', function (\Illuminate\Http\Request $request) {
            $response = app(\App\Modules\Pengelola\Controllers\DashboardController::class)
                ->index($request);

            $data = $response->getData(true);

            return view('pengelola.dashboard.index', [
                'instansi'    => $data['instansi'],
                'pendaftaran' => $data['pendaftaran'],
            ]);
        })->name('pengelola.dashboard');

        Route::get('/pendaftaran',
            [PengelolaPendaftaranController::class, 'page']
        )->name('pengelola.pendaftaran.index');

        Route::get('/pendaftaran/{id}',
            [PengelolaPendaftaranController::class, 'pageDetail']
        )->name('pengelola.pendaftaran.show');

        Route::put('/pendaftaran/{id}/verify',
            [PengelolaPendaftaranController::class, 'verifyWeb']
        )->name('pengelola.pendaftaran.verify');

        Route::put('/pendaftaran/{id}/accept',
            [PengelolaPendaftaranController::class, 'acceptWeb']
        )->name('pengelola.pendaftaran.accept');

        Route::put('/pendaftaran/{id}/reject',
            [PengelolaPendaftaranController::class, 'rejectWeb']
        )->name('pengelola.pendaftaran.reject');

        Route::get('/instansi/edit',
            [InstansiPengelolaController::class, 'edit']
        )->name('pengelola.instansi.edit');

        Route::put('/instansi/edit',
            [InstansiPengelolaController::class, 'update']
        )->name('pengelola.instansi.update');
    });
