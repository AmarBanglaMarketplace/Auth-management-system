<?php

use App\Http\Controllers\Api\Auth\AdminAuthController;
use Illuminate\Support\Facades\Route;


Route::prefix('admin')->controller(AdminAuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
});