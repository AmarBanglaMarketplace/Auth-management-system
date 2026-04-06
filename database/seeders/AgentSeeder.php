<?php

namespace Database\Seeders;

use App\Models\Agent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agent = Agent::create([
            'name' => 'Default Agent',
            'email' => 'agent@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $agent->assignRole('agent');
    }
}
