<?php

namespace Database\Seeders;

use App\Models\Slider;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Slider::create(
            [
                'key' => 'banner_section',
                'image'       => 'https://placehold.co/1300x500',
                'title'       => 'Amputee Football Festival Showcases Rising Talent in Dhaka',
                'description' => 'A spirited celebration of amputee football brought together 45 players...',
                'link'        => '/news-and-updates',
                'order'       => 1,
                'enabled'     => true,
            ],
        );
        Slider::create(
            [
                'key' => 'banner_section',
                'image'       => 'https://placehold.co/1300x500',
                'title'       => 'Another Inspiring Paralympic Event',
                'description' => 'Highlights from the latest para-sports activities in Bangladesh...',
                'link'        => '/blogs',
                'order'       => 2,
                'enabled'     => true,
            ],
        );
        Slider::create(
            [
                'key' => 'banner_section',
                'image'       => 'https://placehold.co/1300x500',
                'title'       => 'Future Paralympic Dreams',
                'description' => 'Bangladesh continues its journey in para-sports with new talent...',
                'link'        => '/photo-gallery',
                'order'       => 3,
                'enabled'     => true,
            ],
        );
    }
}
