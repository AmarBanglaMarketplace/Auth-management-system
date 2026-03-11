<?php

namespace Database\Seeders;

use App\Models\ShopAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ShopAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShopAdmin::create([
            'name' => 'Main Shop Admin',
            'email' => 'shopadmin@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
