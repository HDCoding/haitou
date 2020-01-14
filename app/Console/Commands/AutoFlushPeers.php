<?php

namespace App\Console\Commands;

use App\Models\Historic;
use App\Models\Peer;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoFlushPeers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-flush-peers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Flushes Ghost Peers';

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
        $current = new Carbon();
        $peers = Peer::select(['id', 'info_hash', 'user_id', 'updated_at'])
            ->where('updated_at', '<', $current->copy()->subHours(2)->toDateTimeString())
            ->get();

        foreach ($peers as $peer) {
            $history = Historic::where('info_hash', '=', $peer->info_hash)
                ->where('user_id', '=', $peer->user_id)
                ->first();

            if ($history) {
                $history->is_active = false;
                $history->update();
            }
            $peer->delete();
        }
    }
}
