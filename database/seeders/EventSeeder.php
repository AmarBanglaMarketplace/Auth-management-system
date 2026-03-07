<?php

namespace Database\Seeders;

use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Event::truncate();
        $now = Carbon::now();

        for ($i = 1; $i <= 10; $i++) {
            $title = "Type0 Event {$i}";
            Event::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'event_category_id' => 1,
                    'title'             => $title,
                    'slug'              => Str::slug($title),
                    'description'       => "<p>Description for {$title}</p>",
                    'featured_image'    => "https://placehold.co/400x800?text={$title}",
                    'banner_image'      => "https://placehold.co/2000x600?text={$title}",
                    'start_date'        => Carbon::parse("2025-01-{$i} 09:00:00"),
                    'status'            => 1,
                    'type'              => 0,
                    'event_scope'      => rand(0, 1),
                    'createdBy'         => 1,
                    'updatedBy'         => 1,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]
            );
        }

        // Generate 10 events of type 1
        for ($i = 1; $i <= 10; $i++) {
            $title = "Type1 Event {$i}";
            Event::updateOrCreate(
                ['slug' => Str::slug($title)],
                [
                    'event_category_id' => 2,
                    'title'             => $title,
                    'slug'              => Str::slug($title),
                    'description'       => "<p>Description for {$title}</p>",
                    'featured_image'    => "https://placehold.co/400x300?text={$title}",
                    'banner_image'      => "https://placehold.co/2000x600?text={$title}",
                    'start_date'        => Carbon::parse("2025-02-{$i} 09:00:00"),
                    'status'            => 1,
                    'type'              => 1,
                    'event_scope'       => rand(0, 2),
                    'createdBy'         => 1,
                    'updatedBy'         => 1,
                    'created_at'        => $now,
                    'updated_at'        => $now,
                ]
            );
        }
    }
}
