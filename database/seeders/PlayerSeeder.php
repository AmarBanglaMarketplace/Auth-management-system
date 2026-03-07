<?php
namespace Database\Seeders;

use App\Models\Player;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class PlayerSeeder extends Seeder
{
    public function run(): void
    {
        $players = [
            [
                'name'             => 'Lionel Messi',
                'sport'            => 'Football',
                'position'         => 'Forward',
                'team'             => 'Inter Miami',
                'country'          => 'Argentina',
                'birthdate'        => '1987-06-24',
                'height'           => '170 cm',
                'weight'           => '72 kg',
                'hometown'         => 'Rosario',
                'asian_ranking'    => null,
                'national_ranking' => null,
                'image'            => 'https://placehold.co/200x200?text=Messi',
                'status'           => 1,
            ],
            [
                'name'             => 'Shakib Al Hasan',
                'sport'            => 'Cricket',
                'position'         => 'All-rounder',
                'team'             => 'Bangladesh National Team',
                'country'          => 'Bangladesh',
                'birthdate'        => '1987-03-24',
                'height'           => '175 cm',
                'weight'           => '72 kg',
                'hometown'         => 'Magura',
                'asian_ranking'    => '#1',
                'national_ranking' => '#1',
                'image'            => 'https://placehold.co/200x200?text=Shakib',
                'status'           => 1,
            ],
            [
                'name'             => 'PV Sindhu',
                'sport'            => 'Badminton',
                'position'         => 'Singles',
                'team'             => 'India',
                'country'          => 'India',
                'birthdate'        => '1995-07-05',
                'height'           => '179 cm',
                'weight'           => '65 kg',
                'hometown'         => 'Hyderabad',
                'asian_ranking'    => '#2',
                'national_ranking' => '#1',
                'image'            => 'https://placehold.co/200x200?text=Sindhu',
                'status'           => 1,
            ],
        ];

        foreach ($players as $player) {
            // Generate slug explicitly (name + sport + country)
            $player['slug'] = Str::slug($player['name'] . '-' . $player['sport'] . '-' . $player['country']);

            Player::updateOrCreate(
                ['slug' => $player['slug']], // unique key
                $player                      // full data to insert/update
            );
        }
    }
}
