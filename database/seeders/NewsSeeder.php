<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\NewsCategory;
use App\Models\NewsCategoryMap;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class NewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gamingNews = [
            [
                'news_title'       => 'Bangladesh’s Rapid Rise as South Asia’s Next Esports Battleground',
                'short_des'        => 'Esports cafes and mobile titles are turning Bangladesh into a competitive gaming hub.',
                'description'      => '<p>Internet access and cheap smartphones are fueling esports growth across Bangladesh...</p>',
                'meta_title'       => 'Esports in Bangladesh',
                'meta_keyword'     => 'esports, PUBG, Free Fire, Bangladesh',
                'meta_description' => 'Bangladesh is emerging as South Asia’s next esports battleground.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'Esports Bangladesh',
                'publish_date'     => now()->subDays(2),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'news_title'       => 'Bangladesh Returns to World Cyber Games After 15 Years',
                'short_des'        => 'Four Bangladeshi competitors will take part in the WCG 2025 Global Finals.',
                'description'      => '<p>Bangladesh rejoins the World Cyber Games stage with a team of four players...</p>',
                'meta_title'       => 'World Cyber Games Bangladesh',
                'meta_keyword'     => 'WCG, esports, Bangladesh, cyber games',
                'meta_description' => 'Bangladesh returns to the World Cyber Games after 15 years.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'World Cyber Games',
                'publish_date'     => now()->subDays(5),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'news_title'       => 'Unlocking Bangladesh’s Potential in the Gaming Industry',
                'short_des'        => 'The gaming industry is a thriving economic treasure trove for Bangladesh.',
                'description'      => '<p>Gaming revenue surpasses film and music, creating jobs and boosting GDP...</p>',
                'meta_title'       => 'Gaming Industry Bangladesh',
                'meta_keyword'     => 'gaming, industry, Bangladesh, economy',
                'meta_description' => 'Bangladesh’s gaming industry offers huge economic potential.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'Gaming Industry',
                'publish_date'     => now()->subDays(7),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'news_title'       => 'Future of Bangladeshi Online Gaming in 2025',
                'short_des'        => 'Smartphones and digital payments are driving online gaming growth. Online casinos, sports betting, and e‑gaming platforms are evolving rapidly in Bangladesh',
                'description'      => '<p>Online casinos, sports betting, and e‑gaming platforms are evolving rapidly in Bangladesh...</p>',
                'meta_title'       => 'Online Gaming Bangladesh',
                'meta_keyword'     => 'online gaming, Bangladesh, 2025, trends',
                'meta_description' => 'Trends and innovations shaping online gaming in Bangladesh.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'Online Gaming',
                'publish_date'     => now()->subDays(10),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'news_title'       => 'PUBG Mobile and Free Fire Dominate Youth Gaming in Bangladesh',
                'short_des'        => 'Mobile esports titles are the most popular among Bangladeshi youth.',
                'description'      => '<p>Street cafés and dorm rooms are filled with PUBG and Free Fire squads...</p>',
                'meta_title'       => 'PUBG Free Fire Bangladesh',
                'meta_keyword'     => 'PUBG, Free Fire, mobile gaming, Bangladesh',
                'meta_description' => 'PUBG Mobile and Free Fire dominate youth gaming culture.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'PUBG Free Fire',
                'publish_date'     => now()->subDays(12),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'news_title'       => 'Esports Bangladesh Partners with International Gaming Brands',
                'short_des'        => 'Global brands are investing in Bangladesh’s esports ecosystem.',
                'description'      => '<p>Partnerships with Tencent and other companies are boosting esports infrastructure...</p>',
                'meta_title'       => 'Esports Partnerships Bangladesh',
                'meta_keyword'     => 'esports, partnerships, Bangladesh, Tencent',
                'meta_description' => 'International brands partner with Bangladesh esports scene.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'Esports Partnerships',
                'publish_date'     => now()->subDays(15),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
            [
                'news_title'       => 'Bangladesh Gaming Startups Attract Global Attention',
                'short_des'        => 'Local studios are creating games and attracting investors.',
                'description'      => '<p>Bangladeshi gaming startups are innovating and drawing global interest...</p>',
                'meta_title'       => 'Gaming Startups Bangladesh',
                'meta_keyword'     => 'gaming, startups, Bangladesh, investors',
                'meta_description' => 'Bangladesh gaming startups gain global attention.',
                'image'            => 'https://placehold.co/1400x400',
                'f_image'          => 'https://placehold.co/200x400',
                'alt_name'         => 'Gaming Startups',
                'publish_date'     => now()->subDays(18),
                'status'           => 1,
                'createdBy'        => 1,
                'updatedBy'        => null,
            ],
        ];
        foreach ($gamingNews as $key => $item) {
            if ($key < 6) {
                $item['featured'] = 1;
            }
            News::updateOrCreate(
                ['slug' => Str::slug($item['news_title'])],
                array_merge($item, ['slug' => Str::slug($item['news_title'])])
            );
        }
    }
}
