<?php

namespace Database\Seeders;

use App\Models\EventCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // === ROOT EVENT CATEGORIES ===
        $music        = $this->createCategory('Music', null, 1, 'concerts,live music,festivals');
        $sports       = $this->createCategory('Sports', null, 2, 'football,cricket,basketball');
        $business     = $this->createCategory('Business', null, 3, 'corporate,entrepreneurship,markets');
        $technology   = $this->createCategory('Technology', null, 4, 'gadgets,innovation,startups');
        $entertainment = $this->createCategory('Entertainment', null, 5, 'movies,music,celebrities');
        $health       = $this->createCategory('Health', null, 6, 'wellness,fitness,medicine');
        $lifestyle    = $this->createCategory('Lifestyle', null, 7, 'travel,food,culture');
    }

    private function createCategory($name, $parentId, $sortOrder, $keywords = '')
    {
        return EventCategory::firstOrCreate(
            ['category_name' => $name, 'parent_id' => $parentId],
            [
                'slug'=>Str::slug($name),
                'description'      => "$name related events and articles",
                'meta_title'       => $name,
                'meta_description' => "Latest $name news, updates, and events",
                'meta_keyword'     => $keywords,
                'image'            => "https://placehold.co/600x400?text=" . urlencode($name),
                'alt_name'         => "$name Alt",
                'sort_order'       => $sortOrder,
                'status'           => '1', // Active status
                'createdBy'        => 1,  // Assuming user ID 1 is the creator
                'updatedBy'        => 1,  // Assuming user ID 1 is the updater
            ]
        );
    }
}
