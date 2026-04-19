<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(ShopAdminSeeder::class);
        $this->call(DeliveryBoySeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(AgentSeeder::class);
        $this->call(CustomerSeeder::class);

        Artisan::call("optimize:clear");
    }
}
