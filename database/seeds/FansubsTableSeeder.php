<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FansubsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('fansubs')->insert([
            'name' => 'N/A',
            'slug' => 'n-a',
            'logo' => asset('images/404.png'),
            'description' => 'Usado para upar conteúdo de fansubs que não existem ou não estão cadastrados.',
            'is_active' => true,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
