<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL; // 🚀 Ye line zaroori hai

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
        // 🚀 THE ULTIMATE FIX FOR "NOT SECURE" FORM ERROR ON RAILWAY
        if (env('APP_ENV') !== 'local') {
            URL::forceScheme('https');
        }
    }
}