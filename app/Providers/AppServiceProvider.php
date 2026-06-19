<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // 🚀 Force HTTPS for production environments to resolve "Not Secure" and Mixed Content issues
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}