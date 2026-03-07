<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NewsCategoryMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        News::all()->each(function ($news) {
            // Pick 1 or 2 random categories
            $count = rand(1, 2);

            $categories = NewsCategory::inRandomOrder()
                ->take($count)
                ->pluck('id');

            // Attach them to the news item
            $news->categories()->attach($categories);
        });
    }
}
