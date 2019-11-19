<?php

use Carbon\Carbon;
use App\Models\Media;
use Illuminate\Database\Seeder;

class MediasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $medias = [
            ['category_id' => 10, 'studio_id' => 736, 'name' => 'N/A', 'media_type' => 0, 'released_at' => Carbon::today(), 'poster' => secure_asset('images/no-poster.png'), 'status' => 0, 'description' => 'Usado para upar conteúdo de medias que não existem ou não estão cadastrados.'],
            ['category_id' => 10, 'name' => 'Macross Zero', 'title_english' => 'Macross Zero', 'title_japanese' => 'マクロス ゼロ', 'media_type' => 0, 'studio_id' => 1, 'views' => 0, 'released_at' => '2002-12-21', 'finished_at' => '2004-10-20', 'description' => 'Taking place one year before the Zentraedi arrive on Earth, Macross Zero chronicles the final days of the war between the U.N. Spacy and anti-U.N. factions. After being shot down by the anti-U.N.&#039;s newest fighter plane, ace pilot Shin Kudo finds himself on the remote island of Mayan, where technology is almost non-existent. While Shin stays on the island to heal his wounds, the tranquility of the island is shattered by a battle that involves the UN&#039;s newest fighter - the VF-0. (Source: ANN)', 'is_adult' => 0, 'cover' => NULL, 'poster' => 'https://cdn.myanimelist.net/images/anime/10/24082.jpg', 'status' => 1, 'yt_video' => NULL, 'total_episodes' => 5, 'duration' => 30, 'total_chapters' => NULL, 'total_volumes' => NULL]
        ];

        foreach ($medias as $media) {
            Media::create($media);
        }
    }
}
