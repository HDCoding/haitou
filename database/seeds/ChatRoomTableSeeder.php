<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatRoomTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chatrooms')
            ->insert([
                'name' => 'Geral',
                'image' => asset('images/favicons/android-icon-48x48.png'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
    }
}
