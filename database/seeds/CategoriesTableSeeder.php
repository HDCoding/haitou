<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            //Faq
            ['name' => 'Informações do Site', 'is_faq' => true],
            ['name' => 'Info aos usuários', 'is_faq' => true],
            ['name' => 'Problemas', 'is_faq' => true],
            ['name' => 'Pessoal', 'is_faq' => true],
            ['name' => 'Baixando', 'is_faq' => true],
            ['name' => 'Upando', 'is_faq' => true],
            ['name' => 'FAQ dos Uploaders', 'is_faq' => true],
            ['name' => 'Sem conexão?', 'is_faq' => true],
            ['name' => 'Sem respostas ainda?', 'is_faq' => true],
            //Media
            ['name' => 'TV', 'is_media' => true],
            ['name' => 'TV Curta', 'is_media' => true],
            ['name' => 'Filme', 'is_media' => true],
            ['name' => 'Especial', 'is_media' => true],
            ['name' => 'OVA', 'is_media' => true],
            ['name' => 'ONA', 'is_media' => true],
            ['name' => 'Musical', 'is_media' => true],
            ['name' => 'Manga', 'is_media' => true],
            ['name' => 'Dorama', 'is_media' => true],
            ['name' => 'One Shot', 'is_media' => true],
            ['name' => 'Doujin', 'is_media' => true],
            ['name' => 'Manhua', 'is_media' => true],
            ['name' => 'Manhwa', 'is_media' => true],
            ['name' => 'N/A', 'is_media' => true],
            //Torrent
            ['name' => 'Anime', 'is_torrent' => true],
            ['name' => 'Dorama', 'is_torrent' => true],
            ['name' => 'Filme', 'is_torrent' => true],
            ['name' => 'OVA', 'is_torrent' => true],
            //Forum
            ['name' => 'Site', 'is_forum' => true],
            ['name' => 'Geral', 'is_forum' => true],
            ['name' => 'Wikisub', 'is_forum' => true],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

    }
}
