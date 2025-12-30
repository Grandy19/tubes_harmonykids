<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Path ke "home" untuk user yang sudah login.
     * Ini digunakan oleh RedirectIfAuthenticated middleware.
     * * SEBELUMNYA: '/home' (Salah, route ini gak ada)
     * SEKARANG: '/wali/home' (Benar, route dashboard wali)
     */
    public const HOME = '/wali/home';

    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(300)->by(
                $request->user()?->id ?: $request->ip()
            );
        });

        $this->routes(function () {

            // ================= API CORE =================
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // Load Route API Modules
            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Auth/Routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Instansi/Routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Pendaftaran/Routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/HarmoTalent/Routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Forum/Routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Pengelola/Routes/api.php'));

            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Admin/Routes/api.php'));

            // ================= WEB =================
            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('web')
                ->group(app_path('Modules/HarmoView/Routes/web.php'));
        });
    }
}