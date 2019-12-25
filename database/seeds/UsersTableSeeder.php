<?php

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            ['title' => 'Comentar Atrizes/Atores', 'key' => 'actors_comment', 'value' => true],
            // Calendars
            ['title' => 'Criar Calendario', 'key' => 'calendars_create', 'value' => true],
            ['title' => 'Comentar nos Calendarios', 'key' => 'calendars_comment', 'value' => true],
            // Characters
            ['title' => 'Comentar nos Personagens', 'key' => 'characters_comment', 'value' => true],
            // Chatbox
            ['title' => 'Visualizar Chatbox', 'key' => 'chatbox_view', 'value' => true],
            // Fansubs
            ['title' => 'Comentar nos Fansubs', 'key' => 'fansubs_comment', 'value' => true],
            // Medias
            ['title' => 'Comentar nas Mídias', 'key' => 'medias_comment', 'value' => true],
            // Estudios
            ['title' => 'Comentar nos Estúdios', 'key' => 'studios_comment', 'value' => true],
            // Torrents
            ['title' => 'Comentar nos Torrents', 'key' => 'torrents_comment', 'value' => true],
            ['title' => 'Upload Torrent', 'key' => 'torrents_upload', 'value' => false],
            ['title' => 'Download Torrent', 'key' => 'torrents_download', 'value' => true],
            #STAFF PANEL
            // Beginners
            ['title' => 'Acesso Total', 'key' => 'full_access', 'value' => false],
            ['title' => 'Visualizar Painel Staff', 'key' => 'staff_panel', 'value' => false],
            // Achievements
            ['title' => 'Conquistas Mod', 'key' => 'achievements_mod', 'value' => false],
            // Actors
            ['title' => 'Atores Mod', 'key' => 'actors_mod', 'value' => false],
            // Backups
            ['title' => 'Backups Mod', 'key' => 'backups_mod', 'value' => false],
            // Bonus
            ['title' => 'Bonus Mod', 'key' => 'bonus_mod', 'value' => false],
            // Calendars
            ['title' => 'Calendario Mod', 'key' => 'calendars_mod', 'value' => false],
            // Categories
            ['title' => 'Categorias Mod', 'key' => 'categories_mod', 'value' => false],
            // Characters
            ['title' => 'Personagens Mod', 'key' => 'characters_mod', 'value' => false],
            // Cheaters
            ['title' => 'Cheaters Mod', 'key' => 'cheaters_mod', 'value' => false],
            // Commands
            ['title' => 'Comandos Mod', 'key' => 'commands_mod', 'value' => false],
            // FailedLogins
            ['title' => 'Falhas de Login Mod', 'key' => 'failed_logins_mod', 'value' => false],
            // Fansubs
            ['title' => 'Fansubs Mod', 'key' => 'fansubs_mod', 'value' => false],
            // Faqs
            ['title' => 'Faq Mod', 'key' => 'faqs_mod', 'value' => false],
            // Forums
            ['title' => 'Forum Mod', 'key' => 'forums_mod', 'value' => false],
            // Genres
            ['title' => 'Gêneros Mod', 'key' => 'genres_mod', 'value' => false],
            // Logs
            ['title' => 'Logs Mod', 'key' => 'logs_mod', 'value' => false],
            // Lotteries
            ['title' => 'Sorteios Mod', 'key' => 'lotteries_mod', 'value' => false],
            // Medias
            ['title' => 'Medias Mod', 'key' => 'medias_mod', 'value' => false],
            // Moods
            ['title' => 'Humor Mod', 'key' => 'moods_mod', 'value' => false],
            // News
            ['title' => 'Notícias Mod', 'key' => 'news_mod', 'value' => false],
            // Permissions
            ['title' => 'Permissoes Mod', 'key' => 'permissions_mod', 'value' => false],
            // Polls
            ['title' => 'Pesquisas Mod', 'key' => 'polls_mod', 'value' => false],
            // Reports
            ['title' => 'Relatório Mod', 'key' => 'reports_mod', 'value' => false],
            // Requests
            ['title' => 'Free Slots Mod', 'key' => 'freeslots_mod', 'value' => false],
            // Groups
            ['title' => 'Grupos Mod', 'key' => 'groups_mod', 'value' => false],
            // Rules
            ['title' => 'Regras Mod', 'key' => 'rules_mod', 'value' => false],
            // Settings
            ['title' => 'Configurações Mod', 'key' => 'settings_mod', 'value' => false],
            // Studios
            ['title' => 'Estúdios Mod', 'key' => 'studios_mod', 'value' => false],
            // Torrents
            ['title' => 'Torrents Mod', 'key' => 'torrents_mod', 'value' => false],
            // Users
            ['title' => 'Usuários Mod', 'key' => 'users_mod', 'value' => false],
            // Visitors
            ['title' => 'Visitantes Mod', 'key' => 'visitors_mod', 'value' => false],
        ];

        //$token = Str::random(60);

        $users = [
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 12,
                'username' => 'System',
                'email' => 'system@none.net',
                'password' => bcrypt('951753'),
                'status' => 0,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'permissions' => json_encode($permissions),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 12,
                'username' => 'Bot',
                'email' => 'bot@none.net',
                'password' => bcrypt('159357'),
                'status' => 0,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'permissions' => json_encode($permissions),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'me',
                'email' => 'me@me.com',
                'password' => bcrypt('123123'),
                'status' => 1,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'permissions' => json_encode($permissions),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'mee',
                'email' => 'mee@me.com',
                'password' => bcrypt('123123'),
                'status' => 1,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'permissions' => json_encode($permissions),
                'activated_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
