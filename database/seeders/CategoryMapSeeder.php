<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Seeder;

class CategoryMapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::all()->each(function ($news) {
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id')->toArray();
            $news->categories()->attach($categories);
        });
    }
}
