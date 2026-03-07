<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // -----------------------------------
        // 1. Create Categories
        // -----------------------------------
        $categories = [
            ['category_name' => 'Paralympic Sports', 'parent_id' => null, 'status' => 1],
            ['category_name' => 'Athlete Stories', 'parent_id' => null, 'status' => 1],
            ['category_name' => 'Training & Development', 'parent_id' => null, 'status' => 1],
            ['category_name' => 'International Events', 'parent_id' => null, 'status' => 1],
            ['category_name' => 'Bangladesh Achievements', 'parent_id' => null, 'status' => 1],
        ];

        foreach ($categories as $cat) {
            $cat['slug'] = Str::slug($cat['category_name']);
            BlogCategory::create($cat);
        }

        // -----------------------------------
        // 2. Create Blogs
        // -----------------------------------
        $blogs = [
            [
                'title'       => 'Bangladesh Prepares for the 2025 Asian Para Games',
                'short_des'   => 'NPC Bangladesh begins an intensive training program ahead of the 2025 Asian Para Games.',
                'description' => '<p>The National Paralympic Committee of Bangladesh has launched a nationwide talent development and
            training program to prepare athletes for the 2025 Asian Para Games. The initiative includes
            centralized training camps, coaching upgrades, and medical support...</p>',
                'meta_title'       => 'Asian Para Games 2025 Bangladesh Preparation',
                'meta_keyword'     => 'Asian Para Games, Paralympic Bangladesh, Para Sports',
                'meta_description' => 'NPC Bangladesh begins preparation for the 2025 Asian Para Games with new training programs.',
                'image'            => 'https://placehold.co/1400x400?text=Asian+Para+Games+2025',
                'f_image'          => 'https://placehold.co/200x400?text=Paralympics',
                'alt_name'         => 'Bangladesh Para Games Training',
                'publish_date'     => now()->subDays(2),
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'title'       => 'Inspiring Journey of Bangladeshi Para Swimmer Mahfuzur Rahman',
                'short_des'   => 'From village ponds to international championships—Mahfuzur inspires millions.',
                'description' => '<p>Mahfuzur Rahman, a para swimmer from Dhaka, has overcome physical challenges and financial
            hardship to represent Bangladesh in multiple international swimming events. His story highlights
            resilience, dedication, and the power of inclusive sports...</p>',
                'meta_title'       => 'Bangladeshi Para Athlete Story',
                'meta_keyword'     => 'Para swimmer, Bangladesh athletes, Paralympics',
                'meta_description' => 'The inspiring success story of Bangladeshi para swimmer Mahfuzur Rahman.',
                'image'            => 'https://placehold.co/1400x400?text=Para+Athlete',
                'f_image'          => 'https://placehold.co/200x400?text=Mahfuzur',
                'alt_name'         => 'Para Swimmer Mahfuzur Rahman',
                'publish_date'     => now()->subDays(5),
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'title'       => 'NPC Bangladesh Launches New Athlete Talent Hunt Program',
                'short_des'   => 'A nationwide initiative to identify emerging para athletes.',
                'description' => '<p>To expand the future pool of competitive para athletes, NPC Bangladesh has introduced
            a new Talent Hunt Program across 20 districts. The program aims to scout athletes with physical
            impairments and offer structured training pathways...</p>',
                'meta_title'       => 'Para Athlete Talent Hunt Bangladesh',
                'meta_keyword'     => 'Talent hunt, Paralympics Bangladesh, Para athletes',
                'meta_description' => 'NPC Bangladesh launches a nationwide talent hunt program for para athletes.',
                'image'            => 'https://placehold.co/1400x400?text=Talent+Hunt',
                'f_image'          => 'https://placehold.co/200x400?text=Training',
                'alt_name'         => 'Para Athlete Talent Hunt',
                'publish_date'     => now()->subDays(7),
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'title'       => 'Bangladesh Secures First Medal in World Para Athletics Grand Prix',
                'short_des'   => 'A historic milestone for the nation as para athlete Raihan wins bronze.',
                'description' => '<p>Bangladesh celebrated a historic achievement as para athlete Md. Raihan secured a bronze
            medal in the 400m T47 event at the World Para Athletics Grand Prix. This victory marks a major
            step forward in the nation’s Paralympic journey...</p>',
                'meta_title'       => 'Bangladesh Paralympic Medal News',
                'meta_keyword'     => 'Para Athletics, Bangladesh medal, Paralympics',
                'meta_description' => 'Bangladesh wins its first medal in the World Para Athletics Grand Prix.',
                'image'            => 'https://placehold.co/1400x400?text=Para+Athletics',
                'f_image'          => 'https://placehold.co/200x400?text=Medal',
                'alt_name'         => 'Bangladesh Para Athletics Medal',
                'publish_date'     => now()->subDays(10),
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'title'       => 'International Paralympic Committee Praises Bangladesh’s Progress',
                'slug'        => Str::slug('International Paralympic Committee Praises Bangladesh’s Progress'),
                'short_des'   => 'IPC delegation acknowledges improvements in training, governance, and inclusion.',
                'description' => '<p>A recent visit by the International Paralympic Committee (IPC) praised the rapid
            development of para sports in Bangladesh. The delegation highlighted advancements in athlete
            classification, facility upgrades, and digital governance...</p>',
                'meta_title'       => 'IPC visit to Bangladesh',
                'meta_keyword'     => 'IPC, Paralympics, Bangladesh progress',
                'meta_description' => 'International Paralympic Committee praises Bangladesh for progress.',
                'image'            => 'https://placehold.co/1400x400?text=IPC+Visit',
                'f_image'          => 'https://placehold.co/200x400?text=IPC',
                'alt_name'         => 'IPC Visit Bangladesh',
                'publish_date'     => now()->subDays(12),
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
        ];

        foreach ($blogs as $blogData) {

            $blogData['slug'] = Str::slug($blogData['title']);
            $blogData['status'] = "1";
            $blog = Blog::create($blogData);

            // Auto-category matching
            if (str_contains(strtolower($blog->title), 'training')) {
                $blog->syncCategories([3]); // Training & Development
            } elseif (str_contains(strtolower($blog->title), 'athlete')) {
                $blog->syncCategories([2]); // Athlete Stories
            } elseif (str_contains(strtolower($blog->title), 'medal') || str_contains(strtolower($blog->title), 'achievement')) {
                $blog->syncCategories([5]); // Bangladesh Achievements
            } else {
                $blog->syncCategories([1]); // Paralympic Sports (default)
            }
        }
    }
}
