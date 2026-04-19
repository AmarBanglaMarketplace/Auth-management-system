<?php

namespace Database\Seeders;

use App\Models\Seller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $deviveryBoy = Seller::create([
            'name' => 'Default Seller',
            'email' => 'seller@gmail.com',
            'phone' => '01800000021',
            'password' => Hash::make('12345678'),
        ]);

        $deviveryBoy->assignRole('seller');
    }
}
