<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogCategoryMap;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(PageSeeder::class);
        $this->call(SettingsSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);
        $this->call(CategoryMapSeeder::class);
        $this->call(NewsCategorySeeder::class);
        $this->call(NewsSeeder::class);
        $this->call(MenuSeeder::class);
        $this->call(MenuItemSeeder::class);
        $this->call(EventCategorySeeder::class);
        $this->call(EventSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(GalleryDetailsSeeder::class);
        $this->call(NoticeSeeder::class);
        $this->call(ResultSeeder::class);
        $this->call(NewsCategoryMapSeeder::class);
        $this->call(SectionSeeder::class);
        $this->call(SliderSeeder::class);
        $this->call(BlogSeeder::class);
        $this->call(CommitteeMemberSeeder::class);
        $this->call(PlayerSeeder::class);
        Artisan::call("optimize:clear");
    }
}
