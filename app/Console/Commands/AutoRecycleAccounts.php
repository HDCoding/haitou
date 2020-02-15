<?php

namespace App\Console\Commands;

use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoRecycleAccounts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-recycle-accounts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recycle Non-Activated Account With More 30 Days Old.';

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
        $users = User::where('status', '=', 1)
            ->where('created_at', '<', $current->copy()->subDays(30)->toDateTimeString())
            ->get();

        foreach ($users as $user) {
            $user->delete();
        }
    }
}
