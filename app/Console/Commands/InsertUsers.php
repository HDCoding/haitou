<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class InsertUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = [
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'ContaGmail',
                'email' => 'juaorik@gmail.com',
                'password' => '$2y$10$nMhqPMRVaP.vmrpEgM.9P.A64JHrlltpfzItHedkbmbTtD977Y/Ki',
                'status' => 1,
                'passkey' => '9c87604efc211de1277aedc58f6bce17',
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'guto00741',
                'email' => 'guto00741@hotmail.com',
                'password' => '$2y$10$/eJbyPJo7VhBqCAuew3DKeXHd5Vvgl/keErjpD2JSF3ObMcnkxAJu',
                'status' => 1,
                'passkey' => '854e223181d338999822331881ca1ab8',
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'ContaTutaNota',
                'email' => 'monil@tutanota.com',
                'password' => '$2y$10$.hV2TYJ1UHASi0ITODDFherLegqM0CBoYRfgUnLVtZkqDgPcqExvu',
                'status' => 1,
                'passkey' => '65552227f83cb29c913809ecd8431223',
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'ContaHotmail',
                'email' => 'juaorok@hotmail.com',
                'password' => '$2y$10$yZY0c3klr6eLbEc5qrzhfOmDVOTqQYbW.5TNxJCVKDu2A3tLi1fVq',
                'status' => 1,
                'passkey' => '32528db895c394170bb2a3977e29e927',
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'ContaTerra',
                'email' => 'joaorikardo@terra.com.br',
                'password' => '$2y$10$ZFKZkSYz692U0CwIHLFryOyuYjwd6AsrSRwvHtoT.qIJECHr.iWj2',
                'status' => 1,
                'passkey' => '81bff3889e6359fd47e9ba0503a779ee',
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'ISolidI',
                'email' => 'italomitio@msn.com',
                'password' => '$2y$10$AZLs1A33hdV76C7d6YwK3.iX8UcqSIf5Tbj0XfhWi6WDcDRTPySRi',
                'status' => 1,
                'passkey' => '9c706ba12938492aa2b140d6ac554a0a',
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
