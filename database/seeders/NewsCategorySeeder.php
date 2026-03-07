<?php

namespace Database\Seeders;

use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class NewsCategorySeeder extends Seeder
{
    public function run(): void
    {
        // === ROOT NEWS CATEGORIES ===
        $politics   = $this->createCategory('Games', null, 1, 'government,elections,policy');
        $business   = $this->createCategory('Spotlight', null, 2, 'economy,markets,finance');
        $technology = $this->createCategory('Technology', null, 3, 'tech,innovation,startups');
        $sports     = $this->createCategory('Sports', null, 4, 'football,cricket,basketball');
        $entertainment = $this->createCategory('Entertainment', null, 5, 'movies,music,celebrities');
    }

    private function createCategory($name, $parentId, $sortOrder, $keywords = '')
    {
        return NewsCategory::firstOrCreate(
            ['category_name' => $name, 'parent_id' => $parentId],
            [
                'slug'=>Str::slug($name),
                'description'      => "$name related news and articles",
                'meta_title'       => $name,
                'meta_description' => "Latest $name news, updates and analysis",
                'meta_keyword'     => $keywords,
                'image'            => "https://placehold.co/600x400?text=" . urlencode($name),
                'alt_name'         => "$name Alt",
                'sort_order'       => $sortOrder,
                'status'           => '1',
                'createdBy'        => 1,
                'updatedBy'        => 1,
            ]
        );
    }
}
