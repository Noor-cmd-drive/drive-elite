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
    // Railway par HTTPS force karne ka sab se solid tarika
    \Illuminate\Support\Facades\URL::forceScheme('https');
    
    // Kabhi kabhi Railway proxy ko trust nahi karta, ye line use handle karegi
    $this->app['request']->server->set('HTTPS', 'on');
}
}