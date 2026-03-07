<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GalleryDetailsSeeder extends Seeder
{

    public function run(): void
    {
        // Fetch all gallery IDs
        $galleryIds = Gallery::pluck('id')->toArray();

        // Expanded fake sports data
        $raw = [
            // Football
            ['image' => 'https://placehold.co/400x300?text=Football+Kick', 'alt_name' => 'Football Kick', 'sort_order' => 1],
            ['image' => 'https://placehold.co/400x300?text=Goal+Celebration', 'alt_name' => 'Goal Celebration', 'sort_order' => 2],
            ['image' => 'https://placehold.co/400x300?text=Team+Huddle', 'alt_name' => 'Team Huddle', 'sort_order' => 3],

            // Basketball
            ['image' => 'https://placehold.co/400x300?text=Slam+Dunk', 'alt_name' => 'Slam Dunk', 'sort_order' => 1],
            ['image' => 'https://placehold.co/400x300?text=Three+Pointer', 'alt_name' => 'Three Pointer', 'sort_order' => 2],
            ['image' => 'https://placehold.co/400x300?text=Defense+Block', 'alt_name' => 'Defense Block', 'sort_order' => 3],

            // Cricket
            ['image' => 'https://placehold.co/400x300?text=Cover+Drive', 'alt_name' => 'Cover Drive', 'sort_order' => 1],
            ['image' => 'https://placehold.co/400x300?text=Bowling+Action', 'alt_name' => 'Bowling Action', 'sort_order' => 2],
            ['image' => 'https://placehold.co/400x300?text=Celebrating+Wicket', 'alt_name' => 'Celebrating Wicket', 'sort_order' => 3],

            // Tennis
            ['image' => 'https://placehold.co/400x300?text=Serve+Motion', 'alt_name' => 'Serve Motion', 'sort_order' => 1],
            ['image' => 'https://placehold.co/400x300?text=Backhand+Shot', 'alt_name' => 'Backhand Shot', 'sort_order' => 2],
            ['image' => 'https://placehold.co/400x300?text=Forehand+Winner', 'alt_name' => 'Forehand Winner', 'sort_order' => 3],

            // Swimming
            ['image' => 'https://placehold.co/400x300?text=Freestyle+Stroke', 'alt_name' => 'Freestyle Stroke', 'sort_order' => 1],
            ['image' => 'https://placehold.co/400x300?text=Butterfly+Stroke', 'alt_name' => 'Butterfly Stroke', 'sort_order' => 2],
            ['image' => 'https://placehold.co/400x300?text=Relay+Race', 'alt_name' => 'Relay Race', 'sort_order' => 3],

            // Athletics
            ['image' => 'https://placehold.co/400x300?text=Sprint+Finish', 'alt_name' => 'Sprint Finish', 'sort_order' => 1],
            ['image' => 'https://placehold.co/400x300?text=Long+Jump', 'alt_name' => 'Long Jump', 'sort_order' => 2],
            ['image' => 'https://placehold.co/400x300?text=High+Jump', 'alt_name' => 'High Jump', 'sort_order' => 3],
        ];

        foreach ($raw as $item) {
            GalleryDetail::create([
                'gallery_id' => $galleryIds[array_rand($galleryIds)],
                'image'      => $item['image'],
                'alt_name'   => $item['alt_name'],
                'sort_order' => $item['sort_order'],
                'createdBy'  => 1,
                'updatedBy'  => null,
            ]);
        }
    }
}
