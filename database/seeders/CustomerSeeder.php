<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customer = Customer::create([
            'name' => 'Default Customer',
            'email' => 'customer@gmail.com',
            'phone' => '01800000001',
            'password' => Hash::make('12345678'),
        ]);
        $customer->assignRole('customer');
    }
}
