<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Section::updateOrCreate(
            ['name' => 'about_vision'],
            [
                'data' => [
                    'title' => 'Vision',
                    'image' => 'web/about/vission.png',
                    'content' => '<p class="content-text text-dark-emphasis">
            Through its programs and events, the NPCB’s vision is to foster a truly inclusive Bangladesh,
            where Para athletes have equal opportunities to participate in sports at all levels and are
            recognized for their successes.
        </p>'
                ],
            ]
        );
        Section::updateOrCreate(
            ['name' => 'about_mission_vision'],
            [
                'data' => [
                    'title' => 'Our mission and vision',
                    'image' => 'web/about/mission-visson.png',
                    'content' => '<p class="content-text text-white opacity-75">
                        The mission & vision of the National Paralympic Committee of Bangladesh (NPCB) is aligned with
                        International Paralympic Committee\'s mission & vision. NPCB promotes the Paralympic movement
                        within the country, enabling Para athletes to achieve sporting excellence.
                    </p>',
                    'home_content' => '<p class="content-text text-dark-emphasis">
                        The mission & vision of the National Paralympic Committee of Bangladesh (NPCB) is aligned with
                        International Paralympic Committee\'s mission & vision. NPCB promotes the Paralympic movement
                        within the country, enabling Para athletes to achieve sporting excellence.
                    </p>',
                ],
            ]
        );
        Section::updateOrCreate(
            ['name' => 'about_mission'],
            [
                'data' => [
                    'title' => 'Mission',
                    'image' => 'web/about/mission.png',
                    'content' => '<ul class=" ps-3 ">
                        <li class="text-dark-emphasis content-text mb-4">Supporting members and providing platforms
                            for Para athletes to achieve their best in
                            sports, from national competitions to the Paralympic Games.</li>
                        <li class="text-dark-emphasis content-text mb-4">Using sports as a tool for social and
                            cultural development, fostering hope, independence,
                            and showing that "disability is not inability</li>
                        <li class="text-dark-emphasis content-text mb-4">Leading the development of various Para
                            sports and helping to train coaches and
                            administrators</li>
                        <li class="text-dark-emphasis content-text mb-4">Ensuring the observance of the International
                            Paralympic Committee\'s rules and regulations
                            within Bangladesh</li>
                    </ul>',
                ],
            ]
        );
        Section::updateOrCreate(
            ['name' => 'history_history'],
            [
                'data' => [
                    'title' => 'History',
                    'image' => 'web/history/description.png',
                    'content' => ' <p class="content-text text-white opacity-75">The history of the National Paralympic Committee of Bangladesh (NPCB) was formed in 1981. Bangladesh\'s debut at the Summer Paralympics was in 2004, where it sent one athlete to compete in athletics. The NPCB was formally established in 2004 and became the official national organization for para-sports, affiliated with the International Paralympic Committee (IPC). The country has since participated in every Summer Paralympics, though it has yet to win a medal.</p>
                    <ul class=" ps-3 text-white opacity-75 content-tex">
                        <li class=" t mb-4"><strong>2004: </strong>Bangladesh makes its first appearance at the 2004 Athens Summer Paralympics, sending a single athlete to compete in the men\'s 400m T46 event.</li>

                        <li class="mb-4"><strong>2004: </strong>The National Paralympic Committee of Bangladesh is officially established.</li>

                        <li class="mb-4"><strong>2008: </strong>Abdul Quader Suman represents Bangladesh at the Beijing Paralympics, competing in the men\'s 100m T12.</li>

                        <li class="mb-4"><strong>2012-2024: </strong>Bangladesh continues its participation in the Summer Paralympics.</li>

                        <li class="mb-4"><strong>2022: </strong> NPCB is granted provisional membership status by the International Paralympic Committee (IPC)..</li>
                        <li class="mb-4"><strong>Present: </strong> The organization continues its work as a para-athlete-centered, non-profit national organization based in Dhaka.</li>
                </ul>',
                ],
            ]
        );
    }
}
