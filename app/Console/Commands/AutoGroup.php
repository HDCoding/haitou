<?php

namespace App\Console\Commands;

use App\Models\Group;
use App\Models\Historic;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoGroup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-group';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Change A Users Group Class If Requirements Met';

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
        $current = Carbon::now();
        $groups = Group::select('id')->get()->toArray();
        $users = User::whereIn('group_id', $groups)->get();

        foreach ($users as $user) {
            // Leech ratio dropped below sites minimum
            if ($user->ratio() < 0.4 && $user->group_id != 1) {
                $user->group_id = 1;
                $user->update();
            }

            // User >= 10GB and ratio above sites minimum
            if ($user->uploaded >= 10737418240 && $user->ratio() >= 0.4 && $user->group_id != 2) {
                $user->group_id = 2;
                $user->update();
            }

            // PowerUser >= 1TB and account 1 month old
            if ($user->uploaded >= 1073741824000 && $user->ratio() >= 0.4 && $user->created_at < $current->copy()->subDays(30)->toDateTimeString() && $user->group_id != 3) {
                $user->group_id = 3;
                $user->update();
            }

            // SuperUser >= 5TB and account 2 month old
            if ($user->uploaded >= 1073741824000 * 5 && $user->ratio() >= 0.4 && $user->created_at < $current->copy()->subDays(60)->toDateTimeString() && $user->group_id != 4) {
                $user->group_id = 4;
                $user->update();
            }

            // ExtremeUser >= 20TB and account 3 month old
            if ($user->uploaded >= 1073741824000 * 20 && $user->ratio() >= 0.4 && $user->created_at < $current->copy()->subDays(90)->toDateTimeString() && $user->group_id != 5) {
                $user->group_id = 5;
                $user->update();
            }

            // InsaneUser >= 50TB and account 6 month old
            if ($user->uploaded >= 1073741824000 * 50 && $user->ratio() >= 0.4 && $user->created_at < $current->copy()->subDays(180)->toDateTimeString() && $user->group_id != 8) {
                $user->group_id = 8;
                $user->update();
            }

        }
    }
}
