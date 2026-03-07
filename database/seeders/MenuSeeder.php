<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Header menu
        Menu::updateOrCreate(
            ['name' => 'Main Header'],
            [
                'name'     => 'Main Header',
                'position' => 'header',
                'enabled'  => true,
            ]
        );

        // Create Footer menu
        Menu::updateOrCreate(
            ['name' => 'INFORMATION'],
            [
                'name'     => 'INFORMATION',
                'position' => 'footer',
                'enabled'  => true,
            ]
        );
        Menu::updateOrCreate(
            ['name' => 'NEWS'],
            [
                'name'     => 'NEWS',
                'position' => 'footer',
                'enabled'  => true,
            ]
        );


        // Create Floating Top menu
        Menu::updateOrCreate(
            ['name' => 'Floating Top Menu'],
            [
                'name'     => 'Floating Top Menu',
                'position' => 'Floating Top',
                'enabled'  => true,
            ]
        );
    }
}
