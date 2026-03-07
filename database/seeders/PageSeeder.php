<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Page;
use Faker\Factory as Faker;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        Page::updateOrCreate(
            ["slug" => Str::slug('About Us')],
            [
                'temp'              => 'default',
                'page_title'        => 'About Us',
                'slug'              => Str::slug('About Us'),
                'breadcrumb'       => 'About Us',
                'short_des'         => $faker->sentence(12),
                'page_description'  => '<p class="content-text mt-5">The National Paralympic Committee of Bangladesh (NPCB) is a para-athlete-centered non-profit national organization, affiliated with International Paralympic Committee (IPC). The committee operates under the Bangladesh Sports Council of the Ministry of Youth and Sports of the Government of the People Republic of Bangladesh. NPCB was formed in&nbsp;1981 as a non-profit national organization for para-athletes. NPCB had first sent a team to the 2004 Summer Paralympics in Athens.&nbsp;</p><p class="content-text mt-3">NPBC is the national governing body for the Paralympic Movement in Bangladesh and responsible for promoting the Paralympic values of courage, determination, inspiration, and equality in alignment with IPC. NPBC works to develop sports opportunities for people with disabilities from beginner to elite levels.&nbsp;</p>',
                'f_image'           => 'pages/DjXtlRvdWDsmtPdSoYmOEMW20qPQho2B4Xzm68cq.png',
                'meta_title'        => $faker->sentence(5),
                'meta_description'  => $faker->sentence(20),
                'meta_keyword'      => implode(', ', $faker->words(6)),
                'status'            => 'Active',
                'createdBy'         => 1,
                'updatedBy'         => 1,
            ]
        );
        Page::updateOrCreate(
            ["slug" => Str::slug('Contact Us')],
            [
                'temp'              => 'default',
                'page_title'        => 'Contact Us',
                'breadcrumb'        => 'Contact Us',
                'slug'              => Str::slug('Contact Us'),
                'short_des'         => $faker->sentence(12),
                'page_description'  => '<p><span style="background-color:rgb(255,255,255);color:rgb(33,37,41);"><span style="-webkit-text-stroke-width:0px;display:inline !important;float:none;font-family:&quot;Source Sans Pro&quot;, -apple-system, BlinkMacSystemFont, &quot;Segoe UI&quot;, Roboto, &quot;Helvetica Neue&quot;, Arial, sans-serif, &quot;Apple Color Emoji&quot;, &quot;Segoe UI Emoji&quot;, &quot;Segoe UI Symbol&quot;;font-size:16px;font-style:normal;font-variant-caps:normal;font-variant-ligatures:normal;letter-spacing:normal;orphans:2;text-align:left;text-decoration-color:initial;text-decoration-style:initial;text-decoration-thickness:initial;text-indent:0px;text-transform:none;white-space:normal;widows:2;word-spacing:0px;"><strong>Description</strong></span></span></p>',
                'f_image'           => 'pages/X0D14JzRiv0cAX3gwAdjpE0ZKcrEUPUPFT1xmnWV.png',
                'meta_title'        => $faker->sentence(5),
                'meta_description'  => $faker->sentence(20),
                'meta_keyword'      => implode(', ', $faker->words(6)),
                'status'            => 'Active',
                'createdBy'         => 1,
                'updatedBy'         => 1,
            ]
        );
        Page::updateOrCreate(
            ["slug" => Str::slug('History')],
            [
                'temp'              => 'default',
                'page_title'        => 'History',
                'breadcrumb'        => 'History',
                'slug'              => Str::slug('History'),
                'short_des'         => $faker->sentence(12),
                'page_description'  => '<p class="content-text mt-5">The history of the National Paralympic Committee of Bangladesh (NPCB)&nbsp;was formed in&nbsp;1981. Bangladesh\'s debut at the Summer Paralympics was in 2004, where it sent one athlete to compete in athletics. The NPCB was formally established in 2004 and became the official national organization for para-sports, affiliated with the International Paralympic Committee (IPC). The country has since participated in every Summer Paralympics, though it has yet to win a medal.&nbsp;</p>',
                'f_image'           => 'pages/YLbpHWAdnyZ9fWXJVo4zY9wxXOBud24bNElkUx22.png',
                'meta_title'        => $faker->sentence(5),
                'meta_description'  => $faker->sentence(20),
                'meta_keyword'      => implode(', ', $faker->words(6)),
                'status'            => 'Active',
                'createdBy'         => 1,
                'updatedBy'         => 1,
            ]
        );
        Page::updateOrCreate(
            ["slug" => Str::slug('Sports')],
            [
                'temp'              => 'default',
                'page_title'        => 'Sports',
                'breadcrumb'        => 'Sports',
                'slug'              => Str::slug('Sports'),
                'short_des'         => $faker->sentence(12),
                'page_description'  => '',
                'f_image'           => 'pages/YLbpHWAdnyZ9fWXJVo4zY9wxXOBud24bNElkUx22.png',
                'meta_title'        => $faker->sentence(5),
                'meta_description'  => $faker->sentence(20),
                'meta_keyword'      => implode(', ', $faker->words(6)),
                'status'            => 'Active',
                'createdBy'         => 1,
                'updatedBy'         => 1,
            ]
        );
    }
}
