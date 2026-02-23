<?php

// Forward Vercel requests to laravel index.php
try {
    // Force cache and log paths to /tmp for Vercel's read-only filesystem
    $storagePath = '/tmp/storage';
    $version = getenv('VERCEL_GIT_COMMIT_SHA') ?: 'latest';
    $cachePath = "$storagePath/framework/cache/$version";
    
    if (!is_dir($cachePath)) {
        mkdir($cachePath, 0755, true);
    }
    
    putenv("APP_SERVICES_CACHE=$cachePath/services.php");
    putenv("APP_PACKAGES_CACHE=$cachePath/packages.php");
    putenv("APP_CONFIG_CACHE=$cachePath/config.php");
    putenv("APP_ROUTES_CACHE=$cachePath/routes.php");
    putenv("APP_EVENTS_CACHE=$cachePath/events.php");

    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Early Bootstrap Error</h1>";
    echo "<pre>" . $e->getMessage() . "\n" . $e->getTraceAsString() . "</pre>";
}
