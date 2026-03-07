<?php

namespace Database\Seeders;

use App\Models\Notice;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NoticeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notices = [
            [
                'title' => 'Office Will Remain Closed on Friday',
                'description' => 'The office will remain closed due to maintenance work.',
                'file' => 'notice_1.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
                'type' => 0,
            ],
            [
                'title' => 'National para badminton championships 2025',
                'description' => 'The National para badminton championships 2025 will be held on 15th December 2025.',
                'file' => 'notice_1.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
                'type' => 1,
            ],
            [
                'title' => 'New Policy Update for Employees',
                'description' => 'Please read the updated internal policies and guidelines.',
                'file' => 'policy_update.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
                'type' => 0,
            ],
            [
                'title' => 'Holiday Announcement',
                'description' => 'Upcoming public holiday notice for all staff members.',
                'file' => 'holiday_notice.pdf',
                'createdBy' => 1,
                'updatedBy' => 1,
                'type' => 0,
            ],
            [
                'title' => 'System Downtime Alert',
                'description' => 'Scheduled system maintenance on Saturday from 1 AM to 5 AM.',
                'file' => 'downtime_alert.png',
                'createdBy' => 1,
                'updatedBy' => 1,
                'type' => 0,
            ],
            [
                'title' => 'Training Session Reminder',
                'description' => 'All employees must attend the training session this Sunday.',
                'file' => 'training_schedule.docx',
                'createdBy' => 1,
                'updatedBy' => 1,
                'type' => 1,
            ],
        ];

        foreach ($notices as $notice) {
            Notice::firstOrCreate(
                ['slug' => Str::slug($notice['title'])],
                [
                    'title'       => $notice['title'],
                    'description' => $notice['description'],
                    'file'        => $notice['file'],
                    'createdBy'   => $notice['createdBy'],
                    'updatedBy'   => $notice['updatedBy'],
                    'type'        => $notice['type'],
                ]
            );
        }
    }
}
