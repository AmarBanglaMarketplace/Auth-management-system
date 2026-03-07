<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userId = 1;

        $settings = [
            // General
            ['label' => 'address', 'title' => 'Address', 'value' => 'National Sports Council Old Building
Room #202 (1st Floor), 62/3 Purana Paltan
Dkaka-1000, Bangladesh', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'email', 'title' => 'Email', 'value' => 'info@npcbangladesh.org', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'phone', 'title' => 'Phone', 'value' => '+880 1336097353;  +880 1777-131517', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'state', 'title' => 'State', 'value' => '322', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Branding
            ['label' => 'store_logo', 'title' => 'Store Logo', 'value' => 'https://placehold.co/340x46', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'store_icon', 'title' => 'Store Icon', 'value' => 'https://placehold.co/60x60', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'footer_logo', 'title' => 'Footer Logo', 'value' => 'https://placehold.co/340x46', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'breadcrumb', 'title' => 'Footer Logo', 'value' => 'https://placehold.co/1351x300', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Mail settings
            ['label' => 'mail_protocol', 'title' => 'Mail Protocol', 'value' => 'smtp', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'mail_address', 'title' => 'Mail Address', 'value' => 'imranertaza12@gmail.com', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'send_from', 'title' => 'Send From Mail Address', 'value' => 'support@staging.test.npcbangladesh.org', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'smtp_host', 'title' => 'SMTP Host', 'value' => 'staging.test.npcbangladesh.org', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'smtp_username', 'title' => 'SMTP Username', 'value' => 'support@staging.test.npcbangladesh.org', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'smtp_password', 'title' => 'SMTP Password', 'value' => '[zfLhqfsDcI+', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'smtp_port', 'title' => 'SMTP Port', 'value' => '465', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'smtp_timeout', 'title' => 'SMTP Timeout', 'value' => '300', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'smtp_crypto', 'title' => 'SMTP Crypto', 'value' => 'ssl', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Social links
            ['label' => 'fb_url', 'title' => 'Facebook', 'value' => 'https://www.facebook.com/BangladeshParalympic/', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'twitter_url', 'title' => 'Twitter', 'value' => 'https://twitter.com/npcb', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'linkedin_url', 'title' => 'Linkedin', 'value' => 'https://www.linkedin.com/company/npcbangladesh', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'instagram_url', 'title' => 'Instagram', 'value' => 'https://www.instagram.com/npcb', 'createdBy' => $userId, 'updatedBy' => $userId],

            // SEO basics
            ['label' => 'meta_title', 'title' => 'Meta Title', 'value' => 'National Paralympic Committee of Bangladesh', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'meta_keyword', 'title' => 'Meta Keyword', 'value' => 'NPCB, Paralympics, Bangladesh, Sports', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'meta_description', 'title' => 'Meta Description', 'value' => 'Official site of the National Paralympic Committee of Bangladesh (NPCB).', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Extended SEO
            ['label' => 'meta_author', 'title' => 'Meta Author', 'value' => 'NPCB Admin', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'meta_news_keywords', 'title' => 'News Keywords', 'value' => 'NPCB, Paralympics, Bangladesh, Sports, Athletes', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Open Graph
            ['label' => 'og_type', 'title' => 'OG Type', 'value' => 'article', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'og_title', 'title' => 'OG Title', 'value' => 'NPCB Article', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'og_description', 'title' => 'OG Description', 'value' => 'Discover the latest updates from the National Paralympic Committee of Bangladesh.', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'og_image', 'title' => 'OG Image', 'value' => 'https://placehold.co/1200x630?text=NPCB+OG+Image', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'og_image_width', 'title' => 'OG Image Width', 'value' => '1200', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'og_image_height', 'title' => 'OG Image Height', 'value' => '630', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Twitter Card
            ['label' => 'twitter_card', 'title' => 'Twitter Card', 'value' => 'summary_large_image', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'twitter_title', 'title' => 'Twitter Title', 'value' => 'NPCB', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'twitter_description', 'title' => 'Twitter Description', 'value' => 'Follow updates from the National Paralympic Committee of Bangladesh.', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'twitter_image', 'title' => 'Twitter Image', 'value' => 'https://placehold.co/1200x630?text=NPCB+Twitter+Image', 'createdBy' => $userId, 'updatedBy' => $userId],
            ['label' => 'twitter_domain', 'title' => 'Twitter Domain', 'value' => 'https://npcb.org', 'createdBy' => $userId, 'updatedBy' => $userId],

            // Brand
            ['label' => 'brand_name', 'title' => 'Brand Name', 'value' => 'National Paralympic Committee of Bangladesh', 'createdBy' => $userId, 'updatedBy' => $userId],
        ];

        foreach ($settings as $setting) {
            Setting::updateOrCreate(
                ['label' => $setting['label']],
                $setting
            );
        }
    }
}
