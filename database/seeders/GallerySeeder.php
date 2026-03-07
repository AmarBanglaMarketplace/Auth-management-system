<?php
namespace Database\Seeders;

use App\Models\Gallery;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name'       => 'Football Highlights',
                'thumb'      => 'https://placehold.co/600x400?text=Football',
                'status'=>1,
                'alt_name'   => 'Football Gallery',
                'sort_order' => 1,
                'createdBy'  => 1,
                'updatedBy'  => null,
            ],
            [
                'name'       => 'Basketball Moments',
                'thumb'      => 'https://placehold.co/600x400?text=Basketball',
                'alt_name'   => 'Basketball Gallery',
                'status'=>1,
                'sort_order' => 2,
                'createdBy'  => 1,
                'updatedBy'  => null,
            ],
            [
                'name'       => 'Cricket Shots',
                'thumb'      => 'https://placehold.co/600x400?text=Cricket',
                'alt_name'   => 'Cricket Gallery',
                'status'=>1,
                'sort_order' => 3,
                'createdBy'  => 1,
                'updatedBy'  => null,
            ],
            [
                'name'       => 'Tennis Action',
                'thumb'      => 'https://placehold.co/600x400?text=Tennis',
                'alt_name'   => 'Tennis Gallery',
                'status'     => 1,
                'sort_order' => 4,
                'createdBy'  => 1,
                'updatedBy'  => null,
            ],
        ];

        foreach ($data as $item) {
            $item['scope'] = rand(0, 2);
            Gallery::create($item);
        }
    }
}
