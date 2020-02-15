<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class AutoBirthdayRestore extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-birthday-restore';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically restore gifted users to false every new Year.';

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
        $users = User::all();

        foreach ($users as $user) {
            $user->birth_gifted = false;
            $user->update();
        }
    }
}
