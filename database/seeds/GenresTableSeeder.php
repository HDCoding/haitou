<?php

use App\Models\Genre;
use Illuminate\Database\Seeder;

class GenresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $genres = [
            ['name' => 'Artes Marciais'],
            ['name' => 'Aventura'],
            ['name' => 'Ação'],
            ['name' => 'Bishoujo'],
            ['name' => 'Bishounen'],
            ['name' => 'Comédia'],
            ['name' => 'Comédia Romântica'],
            ['name' => 'Demônio'],
            ['name' => 'Drama'],
            ['name' => 'Ecchi'],
            ['name' => 'Espaço'],
            ['name' => 'Esporte'],
            ['name' => 'Fantasia'],
            ['name' => 'Faroeste'],
            ['name' => 'Ficção Científica'],
            ['name' => 'Harém‎'],
            ['name' => 'Hentai'],
            ['name' => 'Histórico'],
            ['name' => 'Horror'],
            ['name' => 'Jogos'],
            ['name' => 'Josei'],
            ['name' => 'Kodomo'],
            ['name' => 'Live Action'],
            ['name' => 'Magia'],
            ['name' => 'Mecha'],
            ['name' => 'Militar'],
            ['name' => 'Mistério'],
            ['name' => 'Musical'],
            ['name' => 'Paródia'],
            ['name' => 'Policial'],
            ['name' => 'Psicológico'],
            ['name' => 'Romance'],
            ['name' => 'Samurai'],
            ['name' => 'Seinen'],
            ['name' => 'Shoujo'],
            ['name' => 'Shoujo-ai'],
            ['name' => 'Shounen'],
            ['name' => 'Shounen-ai'],
            ['name' => 'Slice Of Life'],
            ['name' => 'Sobrenatural'],
            ['name' => 'Super Poder'],
            ['name' => 'Suspense'],
            ['name' => 'Terror'],
            ['name' => 'Thriller'],
            ['name' => 'Tokusatsu'],
            ['name' => 'Vampiros'],
            ['name' => 'Vida Escolar'],
            ['name' => 'Visual Novels'],
            ['name' => 'Yaoi'],
            ['name' => 'Yuri'],
        ];

        foreach ($genres as $genre) {
            Genre::create($genre);
        }
    }
}
