<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Setting;

class WebsiteServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        try {
            if (Schema::hasTable('settings')) {
                $settings = Setting::all()->pluck('value', 'key');
                View::share('g_settings', $settings);
            }
        } catch (\Exception $e) {
            // Silently fail to allow running migrations via /init-db
            View::share('g_settings', []);
        }
    }
}
