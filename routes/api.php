<?php

use App\Http\Controllers\Api\Auth\AgentAuthenticationController;
use App\Http\Controllers\Api\Auth\CustomerAuthenticationController;
use App\Http\Controllers\Api\Auth\DeliveryBoyAuthenticationController;
use App\Http\Controllers\Api\Auth\ShopAdminAuthenticationController;
use App\Http\Controllers\Api\Auth\SuperAdminAuthenticationController;
use Illuminate\Support\Facades\Route;

// Super Admin
Route::prefix('admins')->controller(SuperAdminAuthenticationController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:user');
});

// Shop Admin
Route::prefix('shop-admins')->controller(ShopAdminAuthenticationController::class)->group(function () {
    Route::post('register', 'register')->middleware(['multi-auth:user,shop-admin']); //create super admin also shop admin
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:shop-admin');
});

// Agent
Route::prefix('agents')->controller(AgentAuthenticationController::class)->group(function () {
    Route::post('register', 'register')->middleware(['multi-auth:shop-admin']); //create shop admin
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:agent');
});

// Delivery Boy
Route::prefix('delivery-boys')->controller(DeliveryBoyAuthenticationController::class)->group(function () {
    Route::post('register', 'register')->middleware(['multi-auth:shop-admin']); //create shop admin
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:delivery-boy');
});

// Customer
Route::prefix('customers')->controller(CustomerAuthenticationController::class)->group(function () {
    Route::post('register', 'register'); //public
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:customer');
});
