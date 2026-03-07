<?php

namespace Database\Seeders;

use App\Models\Result;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $results = [
            [
                'title' => 'Quarter Final Results',
                'description' => 'Results of the quarter final matches.',
                'file' => 'quarter_final.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
            ],
            [
                'title' => 'Semi Final Results',
                'description' => 'Results of the semi final matches.',
                'file' => 'semi_final.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
            ],
            [
                'title' => 'Final Match Results',
                'description' => 'Results of the championship final.',
                'file' => 'final_match.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
            ],
            [
                'title' => 'Top Scorers Report',
                'description' => 'List of top scorers in the tournament.',
                'file' => 'top_scorers.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
            ],
        ];

        foreach ($results as $result) {
            Result::firstOrCreate(
                ['slug' => Str::slug($result['title'])],
                [
                    'title'       => $result['title'],
                    'description' => $result['description'],
                    'file'        => $result['file'],
                    'createdBy'   => $result['createdBy'],
                    'updatedBy'   => $result['updatedBy'],
                ]
            );
        }
    }
}
