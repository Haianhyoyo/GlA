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
            $storagePath = '/tmp/storage';
            
            // Redirect various paths to /tmp
            config(['view.compiled' => "$storagePath/framework/views"]);
            config(['cache.stores.file.path' => "$storagePath/framework/cache"]);
            
            // Use database sessions for persistence in serverless environment
            config(['session.driver' => 'database']);
            config(['session.secure' => true]);
            config(['session.http_only' => true]);
            config(['session.same_site' => 'lax']);
            
            // Critical: Redirect logs to stderr to avoid read-only filesystem error
            config(['logging.default' => 'stderr']);

            // Ensure directories exist
            $dirs = [
                "$storagePath/framework/views",
                "$storagePath/framework/sessions",
                "$storagePath/framework/cache",
                "$storagePath/logs",
            ];

            foreach ($dirs as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }
            }
        }
    }
}
