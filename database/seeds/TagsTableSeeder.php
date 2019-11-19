<?php

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            ['name' => '160p'],
            ['name' => '360p'],
            ['name' => '480p'],
            ['name' => '720p'],
            ['name' => '1080p'],
            ['name' => '1440p'],
            ['name' => '2160p'],
            ['name' => '4K'],
            ['name' => 'TVrip'],
            ['name' => 'DVDrip'],
            ['name' => 'HDVDrip'],
            ['name' => 'BDrip'],
            ['name' => 'BRrip'],
            ['name' => 'SDTV'],
            ['name' => 'HDTV'],
            ['name' => 'WEB-DL'],
            ['name' => 'WEBrip'],
            ['name' => 'x264'],
            ['name' => 'x265'],
            ['name' => 'XviD'],
            ['name' => '3D'],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}
