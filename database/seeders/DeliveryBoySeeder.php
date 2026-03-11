<?php

namespace Database\Seeders;

use App\Models\DeliveryBoy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DeliveryBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DeliveryBoy::create([
            'name' => 'Default Delivery Boy',
            'email' => 'delivery@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
    }
}
