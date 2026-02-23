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
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Set compiled view path to /tmp for Vercel
        if (env('VERCEL')) {
            config(['view.compiled' => '/tmp/storage/framework/views']);
            
            if (!is_dir('/tmp/storage/framework/views')) {
                mkdir('/tmp/storage/framework/views', 0755, true);
            }
        }
    }
}
