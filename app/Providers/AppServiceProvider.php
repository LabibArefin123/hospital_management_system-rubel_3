<?php

namespace App\Providers;

use App\Services\AppointmentService;
use App\Services\PaymentService;
use App\Services\SearchService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}
    public function boot(): void
    {
        app('router')->aliasMiddleware('permission', \App\Http\Middleware\CheckPermission::class);
        Paginator::useBootstrapFive();
        View::composer('frontend.*', function ($view) {
            $user = auth()->user();
            $dashboardRoute = 'dashboard.user';
            if ($user) {
                if ($user->hasRole('admin')) {
                    $dashboardRoute = 'dashboard.admin';
                } elseif ($user->hasRole('doctor')) {
                    $dashboardRoute = 'dashboard.doctor';
                }
            }
            $view->with('dashboardRoute', $dashboardRoute);
        });
    }
}