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
            ['category_id' => 10, 'studio_id' => 736, 'name' => 'N/A', 'media_type' => 0, 'released_at' => Carbon::today(), 'poster' => null, 'status' => 0, 'description' => 'Usado para upar conteúdo de medias que não existem ou não estão cadastrados.'],
        ];

        foreach ($medias as $media) {
            Media::create($media);
        }
    }
}
