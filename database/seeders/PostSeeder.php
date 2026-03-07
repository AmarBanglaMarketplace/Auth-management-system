<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'athletics' => [
                'Athletics Championship Results',
                'Training Tips for Sprinters',
                'Marathon Preparation Guide',
                'Top 10 Long Jump Techniques',
                'Relay Race Team Strategies',
                'Nutrition Tips for Runners',
                'Athletics Meet Highlights',
            ],
            'football' => [
                'Football League Semi-Final Highlights',
                'Top 10 Football Skills to Master',
                'World Cup Qualifier Match Review',
                'Best Goalkeepers of the Season',
                'Football Training Drills for Beginners',
                'Tactical Analysis of Modern Football',
                'Legendary Football Matches Remembered',
            ],
            'cricket' => [
                'Cricket World Cup Match Report',
                'Best Bowling Performances of the Season',
                'Top 10 Batting Partnerships',
                'Cricket T20 League Highlights',
                'Spin Bowling Masterclass',
                'Fitness Tips for Cricketers',
                'Historic Cricket Matches Revisited',
            ],
            'badminton' => [
                'Badminton Doubles Tournament Recap',
                'Improving Your Smash Technique',
                'Singles vs Doubles Strategy',
                'Badminton Footwork Drills',
                'Top Badminton Players of the Year',
                'Badminton Championship Highlights',
                'How to Choose the Right Racket',
            ],
            'swimming' => [
                'Swimming Gala Results',
                'How to Perfect Your Butterfly Stroke',
                'Freestyle Training Techniques',
                'Top 10 Swimming Records Broken',
                'Breathing Exercises for Swimmers',
                'Swimming Relay Team Strategies',
                'Olympic Swimming Highlights',
            ],
        ];

        foreach ($categories as $category => $titles) {
            foreach ($titles as $title) {
                Post::updateOrCreate(
                    ['post_title' => $title],
                    [
                        'post_title'       => $title,
                        'slug'             => Str::slug($title),
                        'short_des'        => "Latest update in {$category}.",
                        'description'      => "<p>This post covers {$category} related news and updates.</p>",
                        'meta_title'       => $title,
                        'meta_keyword'     => "{$category}, sports, results",
                        'meta_description' => "Detailed coverage and insights about {$category}.",
                        'image'            => 'https://placehold.co/1400x400',
                        'f_image'          => 'https://placehold.co/400x200',
                        'alt_name'         => "{$category} image",
                        'publish_date'     => now()->subDays(rand(0, 30)),
                        'status'           => "1",
                        'createdBy'        => 1,
                        'updatedBy'        => null,
                    ]
                );
            }
        }
    }
}
