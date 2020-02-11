<?php

use App\Models\Group;
use Illuminate\Database\Seeder;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            [
                'name' => 'Membro',
                'color' => '#7289DA',
                'icon' => 'fas fa-user',
                'hnr' => 72 * 3600
            ],
            [
                'name' => 'Membro Plus',
                'color' => '#d34836',
                'icon' => 'fas fa-plus-circle',
                'hnr' => 68 * 3600
            ],
            [
                'name' => 'Membro Super',
                'color' => '#FDD023',
                'icon' => 'fas fa-bolt',
                'hnr' => 64 * 3600
            ],
            [
                'name' => 'Membro Extremo',
                'color' => '#4b5320',
                'icon' => 'fas fa-street-view',
                'hnr' => 60 * 3600
            ],
            [
                'name' => 'Membro Mito',
                'color' => '#8b7e7f',
                'icon' => 'fas fa-rocket',
                'hnr' => 56 * 3600
            ],
            [
                'name' => 'V.I.P',
                'color' => '#612F74',
                'icon' => 'fas fa-credit-card',
                'hnr' => 1 * 3600
            ],
            [
                'name' => 'Fansub',
                'color' => '#4ECDB5',
                'icon' => 'fas fa-user-ninja',
                'hnr' => 48 * 3600
            ],
            [
                'name' => 'Uploader',
                'color' => '#61e2ff',
                'icon' => 'fas fa-upload',
                'hnr' => 44 * 3600
            ],
            [
                'name' => 'Moderador Forúns',
                'color' => '#302F35',
                'icon' => 'fas fa-user-tie',
                'hnr' => 40 * 3600
            ],
            [
                'name' => 'Moderador Torrents',
                'color' => '#aa1428',
                'icon' => 'fas fa-user-shield',
                'hnr' => 36 * 3600
            ],
            [
                'name' => 'Admin',
                'color' => '#000042',
                'icon' => 'fas fa-user-astronaut',
                'hnr' => 32 * 3600
            ],
            [
                'name' => 'Bot',
                'color' => '#a4c639',
                'icon' => 'fab fa-android',
                'hnr' => 24 * 3600
            ],
            [
                'name' => 'SysOP',
                'color' => '#4A2C2A',
                'icon' => 'fas fa-user-secret',
                'hnr' => 28 * 3600
            ]
        ];

        foreach ($groups as $group) {
            Group::create($group);
        }
    }
}
