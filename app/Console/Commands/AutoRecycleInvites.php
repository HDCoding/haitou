<?php

namespace App\Console\Commands;

use App\Models\Invitation;
use Illuminate\Console\Command;

class AutoRecycleInvites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-recycle-invites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recycle Invites That Are Expired.';

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
        $current = now();
        $invites = Invitation::whereNull('accepted_by')
            ->whereNull('accepted_at')
            ->where('expires_on', '<', $current)
            ->get();

        foreach ($invites as $invite) {
            $invite->delete();
        }
    }
}
