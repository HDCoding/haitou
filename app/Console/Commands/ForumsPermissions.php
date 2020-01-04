<?php

namespace App\Console\Commands;

use App\Models\Forum;
use App\Models\Group;
use App\Models\Permission;
use Illuminate\Console\Command;

class ForumsPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'forums:permissions';

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
        $forums = Forum::all('id');
        $groups = Group::all('id');

        foreach ($groups as $group) {
            foreach ($forums as $forum) {
                Permission::create([
                    'forum_id' => $forum->id,
                    'group_id' => $group->id,
                    'view_forum' => true,
                    'read_topic' => true,
                    'reply_topic' => true,
                    'start_topic' => true
                ]);
            }
        }
    }
}
