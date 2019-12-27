<?php

use App\Models\Allow;
use Illuminate\Database\Seeder;

class AllowsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $allows = [
            #SITE
            //Actors
            ['name' => 'Comentar Atores'],
            // Calendars
            ['name' => 'Criar Calendário'],
            ['name' => 'Comentar Calendários'],
            // Characters
            ['name' => 'Comentar Personagens'],
            // Chatbox
            ['name' => 'Visualizar Chatbox'],
            // Fansubs
            ['name' => 'Comentar Fansubs'],
            // Medias
            ['name' => 'Comentar Mídias'],
            // Estudios
            ['name' => 'Comentar Estúdios'],
            // Torrents
            ['name' => 'Comentar Torrents'],
            ['name' => 'Upload Torrent'],
            ['name' => 'Download Torrent'],
            #STAFF PANEL
            // Beginners
            ['name' => 'Acesso Total', 'is_staff' => true],
            ['name' => 'Painel Staff', 'is_staff' => true],
            // Achievements
            ['name' => 'Conquistas Mod', 'is_staff' => true],
            // Actors
            ['name' => 'Atores Mod', 'is_staff' => true],
            // Backups
            ['name' => 'Backups Mod', 'is_staff' => true],
            // Bonus
            ['name' => 'Bônus Mod', 'is_staff' => true],
            // Calendars
            ['name' => 'Calendários Mod', 'is_staff' => true],
            // Categories
            ['name' => 'Categorias Mod', 'is_staff' => true],
            // Characters
            ['name' => 'Personagens Mod', 'is_staff' => true],
            // Cheaters
            ['name' => 'Cheaters Mod', 'is_staff' => true],
            // Commands
            ['name' => 'Comandos Mod', 'is_staff' => true],
            // FailedLogins
            ['name' => 'Falhas Login Mod', 'is_staff' => true],
            // Fansubs
            ['name' => 'Fansubs Mod', 'is_staff' => true],
            // Faqs
            ['name' => 'Faq Mod', 'is_staff' => true],
            // Forums
            ['name' => 'Forum Mod', 'is_staff' => true],
            // Genres
            ['name' => 'Gêneros Mod', 'is_staff' => true],
            // Logs
            ['name' => 'Logs Mod', 'is_staff' => true],
            // Lotteries
            ['name' => 'Sorteios Mod', 'is_staff' => true],
            // Medias
            ['name' => 'Mídias Mod', 'is_staff' => true],
            // Moods
            ['name' => 'Humor Mod', 'is_staff' => true],
            // News
            ['name' => 'Notícias Mod', 'is_staff' => true],
            // Permissions
            ['name' => 'Permissões Mod', 'is_staff' => true],
            // Polls
            ['name' => 'Pesquisas Mod', 'is_staff' => true],
            // Reports
            ['name' => 'Relatórios Mod', 'is_staff' => true],
            // Requests
            ['name' => 'FreeSlots Mod', 'is_staff' => true],
            // Groups
            ['name' => 'Grupos Mod', 'is_staff' => true],
            // Rules
            ['name' => 'Regras Mod', 'is_staff' => true],
            // Settings
            ['name' => 'Configurações Mod', 'is_staff' => true],
            // Studios
            ['name' => 'Estúdios Mod', 'is_staff' => true],
            // Torrents
            ['name' => 'Torrents Mod', 'is_staff' => true],
            // Users
            ['name' => 'Usuários Mod', 'is_staff' => true],
            // Visitors
            ['name' => 'Visitantes Mod', 'is_staff' => true]
        ];

        foreach ($allows as $allow) {
            Allow::create($allow);
        }
    }
}
