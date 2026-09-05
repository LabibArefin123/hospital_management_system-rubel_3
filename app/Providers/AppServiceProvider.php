<?php

namespace App\Providers;

use App\Services\AppointmentService;
use App\Services\PaymentService;
use App\Services\SearchService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(AppointmentService::class);
        $this->app->singleton(PaymentService::class);
        $this->app->singleton(SearchService::class);
    }

    public function boot(): void
    {
        app('router')->aliasMiddleware('permission', \App\Http\Middleware\CheckPermission::class);
        Paginator::useBootstrapFive();

    }
}
