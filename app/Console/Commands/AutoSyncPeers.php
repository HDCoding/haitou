<?php

namespace App\Console\Commands;

use App\Models\Torrent;
use Illuminate\Console\Command;

class AutoSyncPeers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-sync-peers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Corrects Torrent Seeders/Leechers (Peers) Count Due To Not Receiving A STOPPED Event From Client.';

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
        $torrents = Torrent::with('peers:remaining')
            ->select(['id', 'seeders', 'leechers'])
            ->get();

        foreach ($torrents as $torrent) {
            $torrent->seeders = $torrent->peers()->where('remaining', '=', 0)->count();
            $torrent->leechers = $torrent->peers()->where('remaining', '>', 0)->count();
            $torrent->save();
        }
    }
}
