<?php

namespace App\Console\Commands;

use App\Models\FailedLogin;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoRecycleFailedLogins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-recycle-failed-logins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recycle Failed Logins Once 30 Days Old.';

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
        $failed_logins = FailedLogin::where('created_at', '<', $current->copy()->subDays(30)->toDateTimeString())->get();

        foreach ($failed_logins as $failed_login) {
            $failed_login->delete();
        }
    }
}
