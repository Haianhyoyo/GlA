<?php

// Forward Vercel requests to laravel index.php
try {
    // Force cache and log paths to /tmp for Vercel's read-only filesystem
    $storagePath = '/tmp/storage';
    if (!is_dir("$storagePath/framework/cache")) {
        mkdir("$storagePath/framework/cache", 0755, true);
    }
    
    putenv("APP_SERVICES_CACHE=$storagePath/services.php");
    putenv("APP_PACKAGES_CACHE=$storagePath/packages.php");
    putenv("APP_CONFIG_CACHE=$storagePath/config.php");
    putenv("APP_ROUTES_CACHE=$storagePath/routes.php");
    putenv("APP_EVENTS_CACHE=$storagePath/events.php");

    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Early Bootstrap Error</h1>";
    echo "<pre>" . $e->getMessage() . "\n" . $e->getTraceAsString() . "</pre>";
}
