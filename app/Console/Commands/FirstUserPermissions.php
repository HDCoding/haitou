<?php

namespace App\Console\Commands;

use App\Models\Allow;
use App\Models\UserAllow;
use Illuminate\Console\Command;

class FirstUserPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Give all permissions to User ID: 3';

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
        $allows = Allow::all();

        foreach ($allows as $allow) {
            UserAllow::create(['user_id' => 3, 'allow_id' => $allow->id]);
        }
    }
}
