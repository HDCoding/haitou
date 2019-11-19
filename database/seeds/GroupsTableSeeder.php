<?php

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            ['name' => 'Membro', 'hnr' => 72 * 3600],
            ['name' => 'Membro Plus', 'hnr' => 68 * 3600],
            ['name' => 'Membro Super', 'hnr' => 64 * 3600],
            ['name' => 'Membro Extremo', 'hnr' => 60 * 3600],
            ['name' => 'Membro Mito', 'hnr' => 56 * 3600],
            ['name' => 'V.I.P', 'hnr' => 52 * 3600],
            ['name' => 'Fansub', 'hnr' => 48 * 3600],
            ['name' => 'Uploader', 'hnr' => 44 * 3600],
            ['name' => 'Moderador Forúns', 'hnr' => 40 * 3600],
            ['name' => 'Moderador Torrents', 'hnr' => 36 * 3600],
            ['name' => 'Admin', 'hnr' => 32 * 3600],
            ['name' => 'Bot', 'hnr' => 24 * 3600],
            ['name' => 'SysOP', 'hnr' => 28 * 3600]
        ];

        foreach ($roles as $role) {
            Group::create($role);
        }
    }
}
