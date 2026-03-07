<?php

namespace Database\Seeders;

use App\Models\CommitteeMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CommitteeMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $members = [
            [
                'name'        => 'Md. Masudul Hassn',
                'designation' => 'President',
                'image'       => 'executive-committee/Md-Masudul-Hassn.png',
                'order'       => 1,
                'status'      => 1,
            ],
            [
                'name'        => 'Mustafa Kamal Shaheen',
                'designation' => 'Vice President -1',
                'image'       => 'executive-committee/Mustafa-Kamal-Shaheen.png',
                'order'       => 2,
            ],
            [
                'name'        => 'Mohammad Nasirul Islam',
                'designation' => 'Vice President -2',
                'image'       => 'executive-committee/Mohammad-Nasirul-Islam.png',
                'order'       => 3,
                'status'      => 1,
            ],
            [
                'name'        => 'Dr. Maruf Ahmed Mridul',
                'designation' => 'Secretary General',
                'image'       => 'executive-committee/Dr-Maruf-Ahmed-Mridul.png',
                'order'       => 4,
                'status'      => 1,
            ],
            [
                'name'        => 'Md. Sanuar Hossain',
                'designation' => 'Joint Secretary General',
                'image'       => 'executive-committee/Md-Sanuar-Hossain.png',
                'order'       => 5,
                'status'      => 1,
            ],
            [
                'name'        => 'Md. Asiful Hasan Masud',
                'designation' => 'Treasurer',
                'image'       => 'executive-committee/Md-Asiful-Hasan-Masud.png',
                'order'       => 6,
                'status'      => 1,
            ],
            [
                'name'        => 'Dr. Mohammad Sohrab',
                'designation' => 'Member-1',
                'image'       => 'executive-committee/Dr-Mohammad-Sohrab.png',
                'order'       => 7,
                'status'      => 1,
            ],
            [
                'name'        => 'Md. Saif Uddin',
                'designation' => 'Member-2',
                'image'       => 'executive-committee/Md-Saif-Uddin.png',
                'status'      => 1,
                'order'       => 8,
            ],
            [
                'name'        => 'Mir Enayet Hossain',
                'designation' => 'Member-3',
                'image'       => 'executive-committee/Mir-Enayet-Hossain.png',
                'status'      => 1,
                'order'       => 9,
            ],
            [
                'name'        => 'Md. Hedaetul Aziz (Monna)',
                'designation' => 'Member-4',
                'image'       => 'executive-committee/Md-Hedaetul-Aziz-Monna.png',
                'status'      => 1,
                'order'       => 10,
            ],
            [
                'name'        => 'Pappu Lal Modak',
                'designation' => 'Member-5',
                'image'       => 'executive-committee/Pappu-Lal-Modak.png',
                'status'      => 1,
                'order'       => 11,
            ],
            [
                'name'        => 'Md. Anwar Kabir Chowdhury',
                'designation' => 'Member-6',
                'image'       => 'executive-committee/Md-Anwar-Kabir-Chowdhury.png',
                'status'      => 1,
                'order'       => 12,
            ],
            [
                'name'        => 'Salim Rahman',
                'designation' => 'Member-7',
                'image'       => 'executive-committee/Salim-Rahman.png',
                'status'      => 1,
                'order'       => 13,
            ],
        ];

        foreach ($members as $member) {
            $member['slug'] = Str::slug($member['name'] . '-' . ($member['designation'] ?? ''));
            CommitteeMember::updateOrCreate(
                ['name' => $member['name']],
                $member
            );
        }
    }
}
