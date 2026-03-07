<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get existing menus
        $headerMenu = Menu::where('position', 'header')->first();
        $footerMenu = Menu::where('position', 'footer')->get();
        $footerMenu1 = $footerMenu[0]->id;
        $footerMenu2 = $footerMenu[1]->id;
        /**
         * Header Menu Items
         */
        // fresh the table first
        $home = MenuItem::updateOrCreate(
            ['name' => 'Home'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'Home',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/',
                'enabled'   => true,
                'order'     => 1,
            ]
        );

        // About dropdown
        $about = MenuItem::updateOrCreate(
            ['name' => 'About'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'About',
                'icon'      => 'fas fa-info-circle',
                'link_type' => 'url',
                'url'       => '#',
                'enabled'   => true,
                'order'     => 2,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'About Us'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $about->id,
                'name'      => 'About Us',
                'link_type' => 'url',
                'url'       => '/pages/about-us',
                'enabled'   => true,
                'order'     => 1,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'History'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $about->id,
                'name'      => 'History',
                'link_type' => 'url',
                'url'       => '/pages/history',
                'enabled'   => true,
                'order'     => 2,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Executive Committee'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $about->id,
                'name'      => 'Executive Committee',
                'link_type' => 'url',
                'url'       => '/executive-committee',
                'enabled'   => true,
                'order'     => 3,
            ]
        );

        // Sports dropdown
        $sports = MenuItem::updateOrCreate(
            ['name' => 'Sports'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'Sports',
                'icon'      => 'fas fa-futbol',
                'link_type' => 'url',
                'url'       => '/sports',
                'enabled'   => true,
                'order'     => 3,
            ]
        );
         MenuItem::updateOrCreate(
            ['name' => 'Athletics'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $sports->id,
                'name'      => 'Athletics',
                'link_type' => 'url',
                'url'       => '/post-categories/athletics',
                'enabled'   => true,
                'order'     => 1,
            ]
        );
         MenuItem::updateOrCreate(
            ['name' => 'Football'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $sports->id,
                'name'      => 'Football',
                'link_type' => 'url',
                'url'       => '/post-categories/football',
                'enabled'   => true,
                'order'     => 2,
            ]
        );
         MenuItem::updateOrCreate(
            ['name' => 'Cricket'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $sports->id,
                'name'      => 'Cricket',
                'link_type' => 'url',
                'url'       => '/post-categories/cricket',
                'enabled'   => true,
                'order'     => 3,
            ]
        );
         MenuItem::updateOrCreate(
            ['name' => 'Badminton'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $sports->id,
                'name'      => 'Badminton',
                'link_type' => 'url',
                'url'       => '/post-categories/badminton',
                'enabled'   => true,
                'order'     => 4,
            ]
        );
         MenuItem::updateOrCreate(
            ['name' => 'Swimming'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $sports->id,
                'name'      => 'Swimming',
                'link_type' => 'url',
                'url'       => '/post-categories/swimming',
                'enabled'   => true,
                'order'     => 5,
            ]
        );
        // Events & Fixtures dropdown
        $events = MenuItem::updateOrCreate(
            ['name' => 'Events & Fixtures'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'Events & Fixtures',
                'icon'      => 'fas fa-calendar-alt',
                'link_type' => 'url',
                'url'       => '#',
                'enabled'   => true,
                'order'     => 4,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Running Event'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $events->id,
                'name'      => 'Running Event',
                'link_type' => 'url',
                'url'       => '/running-events',
                'enabled'   => true,
                'order'     => 1,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Upcoming Event'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $events->id,
                'name'      => 'Upcoming Event',
                'link_type' => 'url',
                'url'       => '/upcoming-events',
                'enabled'   => true,
                'order'     => 2,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Match Fixtures'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $events->id,
                'name'      => 'Match Fixtures',
                'link_type' => 'url',
                'url'       => '/match-fixtures',
                'enabled'   => true,
                'order'     => 3,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Tournament Result'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $events->id,
                'name'      => 'Tournament Result',
                'link_type' => 'url',
                'url'       => '/tournament-result',
                'enabled'   => true,
                'order'     => 4,
            ]
        );

        // News & Updates dropdown
        $news = MenuItem::updateOrCreate(
            ['name' => 'News & Updates'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'News & Updates',
                'icon'      => 'fas fa-newspaper',
                'link_type' => 'url',
                'url'       => '#',
                'enabled'   => true,
                'order'     => 5,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Notice Board'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $news->id,
                'name'      => 'Notice Board',
                'link_type' => 'url',
                'url'       => '/notice-board',
                'enabled'   => true,
                'order'     => 1,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'News'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $news->id,
                'name'      => 'News',
                'link_type' => 'url',
                'url'       => '/news-and-updates',
                'enabled'   => true,
                'order'     => 2,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Spotlights'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $news->id,
                'name'      => 'Spotlights',
                'link_type' => 'url',
                'url'       => '/spotlights',
                'enabled'   => true,
                'order'     => 4,
            ]
        );
        MenuItem::updateOrCreate(
            ['name' => 'Blog'],
            [
                'menu_id'   => $headerMenu->id,
                'parent_id' => $news->id,
                'name'      => 'Blog',
                'link_type' => 'url',
                'url'       => '/blogs',
                'enabled'   => true,
                'order'     => 5,
            ]
        );

        // Gallery dropdown
        $gallery = MenuItem::updateOrCreate(
            ['name' => 'Gallery'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'Gallery',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/photo-gallery',
                'enabled'   => true,
                'order'     => 6,
            ]
        );
        // Contact
        MenuItem::updateOrCreate(
            ['name' => 'Contact Us'],
            [
                'menu_id'   => $headerMenu->id,
                'name'      => 'Contact Us',
                'icon'      => 'fas fa-envelope',
                'link_type' => 'url',
                'url'       => '/pages/contact-us',
                'enabled'   => true,
                'order'     => 7,
            ]
        );

        /**
         * Footer Menu Items
         */
        // Footer Menu Items
        MenuItem::updateOrCreate(
            ['name' => 'About Us', 'menu_id' => $footerMenu1],
            [
                'menu_id'   => $footerMenu1,
                'name'      => 'About Us',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/pages/about-us',
                'enabled'   => true,
                'order'     => 1,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'History', 'menu_id' => $footerMenu1],
            [
                'menu_id'   => $footerMenu1,
                'name'      => 'History',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/pages/history',
                'enabled'   => true,
                'order'     => 2,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'Mission & Vision', 'menu_id' => $footerMenu1],
            [
                'menu_id'   => $footerMenu1,
                'name'      => 'Mission & Vision',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/pages/mission-vision',
                'enabled'   => true,
                'order'     => 3,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'BPC Committee', 'menu_id' => $footerMenu1],
            [
                'menu_id'   => $footerMenu1,
                'name'      => 'BPC Committee',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/executive-committee',
                'enabled'   => true,
                'order'     => 4,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'FAQs', 'menu_id' => $footerMenu1],
            [
                'menu_id'   => $footerMenu1,
                'name'      => 'FAQs',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/faqs',
                'enabled'   => true,
                'order'     => 5,
            ]
        );


        MenuItem::updateOrCreate(
            ['name' => 'Corporate', 'menu_id' => $footerMenu2],
            [
                'menu_id'   => $footerMenu2,
                'name'      => 'Corporate',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/corporate',
                'enabled'   => true,
                'order'     => 6,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'Athletes', 'menu_id' => $footerMenu2],
            [
                'menu_id'   => $footerMenu2,
                'name'      => 'Athletes',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/athletes',
                'enabled'   => true,
                'order'     => 7,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'Event', 'menu_id' => $footerMenu2],
            [
                'menu_id'   => $footerMenu2,
                'name'      => 'Event',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/events',
                'enabled'   => true,
                'order'     => 8,
            ]
        );

        MenuItem::updateOrCreate(
            ['name' => 'Sports', 'menu_id' => $footerMenu2],
            [
                'menu_id'   => $footerMenu2,
                'name'      => 'Sports',
                'icon'      => '',
                'link_type' => 'url',
                'url'       => '/sports',
                'enabled'   => true,
                'order'     => 9,
            ]
        );
    }
}
