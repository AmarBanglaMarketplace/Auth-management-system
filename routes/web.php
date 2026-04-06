<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/* Utility route for clearing all caches */

Route::get('/clear', function () {
    Artisan::call('optimize:clear');

    $cacheDir = public_path('cache');
    if (File::exists($cacheDir)) {
        File::deleteDirectory($cacheDir);
    }

    return "Application cache cleared!";
});

Route::get('/', function () {
    return 'Welcome to auth manager';
});
