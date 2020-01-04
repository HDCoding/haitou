<?php

use App\Models\Forum;
use Illuminate\Database\Seeder;

class ForumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $forums = [
            //Site
            ['category_id' => 28, 'name' => 'Regras e Novidades', 'description' => 'Alarde de preceitos arcaicos e modernos para utentes'],
            ['category_id' => 28, 'name' => 'Dúvidas e Sugestões', 'description' => 'As consequências dos fatos que ocorrem durante a reestruturação de ideias'],
            //Geral
            ['category_id' => 29, 'name' => 'Anime e Mangá', 'description' => 'Espaço para o estudo da cultura moderna visualmente dirigida'],
            ['category_id' => 29, 'name' => 'Bate-Papo', 'description' => 'Discussão sobre o efeito sublime da dissimulação trazida através da maquiagem e roupas nas barreiras mentais'],
            ['category_id' => 29, 'name' => 'Arena', 'description' => 'Espaço reservado a captação de questões e suas capacidades intelectuais totalmente dirigidas a resoluções fora do cotidiano'],
            ['category_id' => 29, 'name' => 'Asian Life Style & Doramas', 'description' => 'Análise das composições cíclicas ou singulares de sustentáculos genuínos'],
            ['category_id' => 29, 'name' => 'Otaku Art & Design', 'description' => 'A habilidade de sublimar devaneios e fantasias em criações excêntricas e inovadoras'],
            ['category_id' => 29, 'name' => 'Informática e Games', 'description' => 'Estudo psicanalítico da abstração e alienação que novas fronteiras causam a mente humana'],
            ['category_id' => 29, 'name' => 'Dark Side', 'description' => 'Desdobramento de experiencias físicas e mentais em tópicos lúbricos'],
            ['category_id' => 29, 'name' => 'Fansub', 'description' => 'Dificuldades e méritos da promoção da cultura oriental'],
            ['category_id' => 29, 'name' => 'Tutoriais', 'description' => 'A existência e não existência de tarefas implicatórias sobre situações especialmente isoladas'],
            ['category_id' => 29, 'name' => 'Eventos e Haitou Encontros', 'description' => 'Relacionamentos da juventude moderna através do entretenimento e do consumo'],
            ['category_id' => 29, 'name' => 'Troca-Troca', 'description' => 'Consumo como meio ilusório de saciar desejos latentes'],
            //Wikisub
            ['category_id' => 30, 'name' => 'Wikisub', 'description' => 'Dedicado exclusivamente ao Wikisub'],
            ['category_id' => 30, 'name' => 'Legendas e Karaokê', 'description' => 'Compartilhe as suas legendas e seus karaokes com o pessoal'],
        ];

        foreach ($forums as $forum) {
            Forum::create($forum);
        }
    }
}
