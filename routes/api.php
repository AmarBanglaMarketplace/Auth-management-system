<?php

use App\Http\Controllers\Api\Auth\AgentAuthenticationController;
use App\Http\Controllers\Api\Auth\CustomerAuthenticationController;
use App\Http\Controllers\Api\Auth\DeliveryBoyAuthenticationController;
use App\Http\Controllers\Api\Auth\ShopAdminAuthenticationController;
use App\Http\Controllers\Api\Auth\SuperAdminAuthenticationController;
use App\Http\Controllers\Api\SuperAdmin\RolePermissionController;
use App\Http\Controllers\SuperAdmin\SuperAdminUserManagementController;
use Illuminate\Support\Facades\Route;

// Super Admin
Route::prefix('admins')->controller(SuperAdminAuthenticationController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:user');
    Route::post('update-password', 'updatePassword')->middleware('auth:user');

    Route::middleware(['auth:user', 'role:super-admin'])->controller(RolePermissionController::class)->group(function () {
        // 🔹 Role management
        Route::post('/roles', 'createRole');                                       // Create a new role
        Route::get('/roles', 'getRolesByGuard');                                  // Get all roles by guard_name
        Route::get('/get-roles', 'getRoles');                                    // Get all roles by guard_name
        Route::delete('/roles/{role}', 'deleteRole');
        Route::get('/roles/{role}/permissions', 'getPermissionsByRole');       // Get all permissions for a role

        // 🔹 Permission management
        Route::get('/permissions', 'getPermissions');                     // Create a new permission
        Route::post('/permissions', 'createPermission');                     // Create a new permission
        Route::delete('/permissions/{permission}', 'deletePermission');
        Route::post('/roles/{role}/permission', 'assignPermissionToRole'); // Assign permissions to a role
        Route::put('/roles/{role}/permissions', 'syncPermissionsForRole');
        Route::delete('/roles/{role}/permissions', 'removePermissionFromRole');

        // 🔹 User management
        Route::post('/users/{userId}/roles', 'assignRoleToUser');
        Route::delete('/users/{userId}/roles', 'removeRoleFromUser');
    });

    Route::middleware(['auth:user', 'role:super-admin'])->controller(SuperAdminUserManagementController::class)->group(function () {
        // manage shop admin
        Route::post('shop-admin/{user}/update-password', 'updateShopAdminPassword');
        Route::post('agent/{user}/update-password', 'updateAgentPassword');
        Route::post('delivery-boy/{user}/update-password', 'updateDeliveryBoyPassword');
        Route::post('customer/{user}/update-password', 'updateCustomerPassword');
    });
});

// Shop Admin
Route::prefix('shop-admins')->controller(ShopAdminAuthenticationController::class)->group(function () {
    Route::post('register', 'register')->middleware(['multi-auth:user,shop-admin']); //create super admin also shop admin
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:shop-admin');
    Route::post('update-password', 'updatePassword')->middleware('auth:shop-admin');
});

// Agent
Route::prefix('agents')->controller(AgentAuthenticationController::class)->group(function () {
    Route::post('register', 'register')->middleware(['multi-auth:shop-admin']); //create shop admin
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('logout', 'logout')->middleware('auth:agent');
    Route::post('update-password', 'updatePassword')->middleware('auth:agent');
});

// Delivery Boy
Route::prefix('delivery-boys')->controller(DeliveryBoyAuthenticationController::class)->group(function () {
    Route::post('register', 'register')->middleware(['multi-auth:shop-admin']); //create shop admin
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('send-otp', 'sendOtp')->middleware('throttle:1,5');
    Route::post('reset-password', 'validateOtpAndResetPassword');
    Route::post('logout', 'logout')->middleware('auth:delivery-boy');
    Route::post('update-password', 'updatePassword')->middleware('auth:delivery-boy');
});

// Customer
Route::prefix('customers')->controller(CustomerAuthenticationController::class)->group(function () {
    Route::post('register', 'register'); //public
    Route::post('login', 'login');
    Route::post('validate-token', 'validateToken');
    Route::post('send-otp', 'sendOtp')->middleware('throttle:1,5');
    Route::post('reset-password', 'validateOtpAndResetPassword');
    Route::post('logout', 'logout')->middleware('auth:customer');
    Route::post('update-password', 'updatePassword')->middleware('auth:customer');
});
