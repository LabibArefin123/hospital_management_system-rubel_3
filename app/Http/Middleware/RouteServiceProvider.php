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
     * |--------------------------------------------------------------------------
     * HOME ROUTE
     * |--------------------------------------------------------------------------
     *
     * Default redirect after authentication.
     *
     * We keep this generic because role-based redirect
     * is handled manually inside AuthenticatedSessionController.
     *
     */

    public const HOME = '/';

    /**
     * Define your route model bindings,
     * pattern filters,
     * and route configuration.
     */
    public function boot(): void
    {
        /*
        |--------------------------------------------------------------------------
        | API RATE LIMITER
        |--------------------------------------------------------------------------
        */

        RateLimiter::for('api', function (Request $request) {

            return Limit::perMinute(60)->by(
                $request->user()?->id ?: $request->ip()
            );
        });

        /*
        |--------------------------------------------------------------------------
        | REGISTER ROUTES
        |--------------------------------------------------------------------------
        */

        $this->routes(function () {

            /*
            |--------------------------------------------------------------------------
            | API ROUTES
            |--------------------------------------------------------------------------
            */

            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            /*
            |--------------------------------------------------------------------------
            | WEB ROUTES
            |--------------------------------------------------------------------------
            */

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
