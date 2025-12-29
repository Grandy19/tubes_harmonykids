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
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {

        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(300)->by(
                $request->user()?->id ?: $request->ip()
            );
        });

        $this->routes(function () {

            // CORE API
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            // MODULE: AUTH (kalau ada)
            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Auth/Routes/api.php'));

            // MODULE: INSTANSI (INI YANG BARU)
            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Instansi/Routes/api.php'));
            
            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/Pendaftaran/Routes/api.php'));
            
            Route::middleware('api')
                ->prefix('api')
                ->group(app_path('Modules/HarmoView/Routes/api.php'));

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

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
