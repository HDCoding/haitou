<?php

use Carbon\Carbon;
use App\Models\Permission;
use App\Models\UserPrivacy;
use App\Models\UserSetting;
use App\User;
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
        $token = Str::random(60);

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
                'activated_at' => Carbon::now()
            ]
        ];

        foreach ($users as $user) {
            User::create($user);
        }

//        sleep(5);

//        foreach (User::all() as $member) {
//            Permission::create(['user_id' => $member->id]);
//        }
    }
}
