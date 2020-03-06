<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call([
             StatesTableSeeder::class,
             CategoriesTableSeeder::class,
             GroupsTableSeeder::class,
             FansubsTableSeeder::class,
             BonusTableSeeder::class,
             SettingsTableSeeder::class,
             MoodsTableSeeder::class,
             GenresTableSeeder::class,
             StudiosTableSeeder::class,
             UsersTableSeeder::class,
             FaqTableSeeder::class,
             MediasTableSeeder::class,
             RulesTableSeeder::class,
             TagsTableSeeder::class,
             AllowsTableSeeder::class,
             ForumTableSeeder::class,
             ChatRoomTableSeeder::class
         ]);
    }
}
