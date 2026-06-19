<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
{
    // Mengalihkan cache penulisan temporary ke folder /tmp milik Vercel
    if (env('APP_ENV') === 'production') {
        $this->app->bind('filesystem.disk', function () {
            return $this->app->make('filesystem')->disk('local');
        });
    }
}


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }
    }
}
