<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $guards = ['user', 'shop-admin', 'agent', 'delivery-boy', 'customer'];

        $permissions = [
            'upload-file',
            'rename-file',
            'delete-file',
            'create-folder',
            'rename-folder',
            'delete-folder',
            'manage-role-permission'
        ];

        foreach ($guards as $guard) {
            foreach ($permissions as $permission) {
                Permission::firstOrCreate([
                    'name' => $permission,
                    'guard_name' => $guard
                ]);
            }
        }

        // Super Admin (general user guard)
        $superAdmin = Role::firstOrCreate(['name' => 'super-admin', 'guard_name' => 'user']);
        $superAdmin->syncPermissions(Permission::where('guard_name', 'user')->get());
        // // Shop Admin
        $shopAdmin = Role::create(['name' => 'shop-admin', 'guard_name' => 'shop-admin']);
        // $manageShop = Permission::create(['name' => 'manage-shop', 'guard_name' => 'shop-admin']);
        // $shopAdmin->givePermissionTo($manageShop);

        // // Agent
        $agent = Role::create(['name' => 'agent', 'guard_name' => 'agent']);
        // $handleOrders = Permission::create(['name' => 'handle-orders', 'guard_name' => 'agent']);
        // $agent->givePermissionTo($handleOrders);
        // Seller
        $deliveryBoy = Role::create(['name' => 'seller', 'guard_name' => 'seller']);
        // // Delivery Boy
        $deliveryBoy = Role::create(['name' => 'delivery-boy', 'guard_name' => 'delivery-boy']);
        // $acceptDelivery = Permission::create(['name' => 'accept-delivery', 'guard_name' => 'delivery-boy']);
        // $updateStatus = Permission::create(['name' => 'update-status', 'guard_name' => 'delivery-boy']);
        // $deliveryBoy->givePermissionTo([$acceptDelivery, $updateStatus]);

        // // Customer
        $customer = Role::create(['name' => 'customer', 'guard_name' => 'customer']);
        // $placeOrder = Permission::create(['name' => 'place-order', 'guard_name' => 'customer']);
        // $viewDashboard = Permission::create(['name' => 'view-dashboard', 'guard_name' => 'customer']);
        // $customer->givePermissionTo([$placeOrder, $viewDashboard]);
    }
}
