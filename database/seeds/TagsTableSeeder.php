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
            ['name' => 'AAC'],
            ['name' => '160p'],
            ['name' => '360p'],
            ['name' => '480p'],
            ['name' => '720p'],
            ['name' => '1080p'],
            ['name' => '1440p'],
            ['name' => '2160p'],
            ['name' => '4K'],
            ['name' => 'TVRip'],
            ['name' => 'DVDRip'],
            ['name' => 'HDVDRip'],
            ['name' => 'BDRip'],
            ['name' => 'BRRip'],
            ['name' => 'SDTV'],
            ['name' => 'HDTV'],
            ['name' => 'WEBDL'],
            ['name' => 'WEBRip'],
			['name' => 'H263'],
			['name' => 'H264'],
			['name' => 'H265'],
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
