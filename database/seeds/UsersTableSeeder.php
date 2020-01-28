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
        //$token = Str::random(60);

        $users = [
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 12,
                'username' => 'System',
                'email' => 'system@haitou.net',
                'password' => bcrypt(sha1_gen()),
                'status' => 1,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 12,
                'username' => 'Bot',
                'email' => 'bot@haitou.net',
                'password' => bcrypt(sha1_gen()),
                'status' => 1,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ],
            [
                'mood_id' => 1,
                'state_id' => 25,
                'group_id' => 1,
                'username' => 'monil',
                'email' => 'monil@me.com',
                'password' => bcrypt('123123'),
                'status' => 1,
                'passkey' => md5_gen(),
                'birthday' => Carbon::today(),
                'activated_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

    }
}
