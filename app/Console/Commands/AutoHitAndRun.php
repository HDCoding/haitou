<?php

namespace App\Console\Commands;

use App\Models\Historic;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoHitAndRun extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-hit-and-run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Post Warnings To Users Accounts and Moderates Table';

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
        if (setting('rnh_on') == true) {
            $current = new Carbon();
            $historics = Historic::with(['user', 'torrent'])
                ->where('real_downloaded', '>', 0)
                ->where('is_released', '=', 0)
                ->where('is_active', '=', 0)
                ->where('seed_time', '<', 201600)
                ->where('updated_at', '<', $current->copy()->subDays(3)->toDateTimeString())
                ->get();

            foreach ($historics as $historic) {
                //checa se o usuario tem direitos de VIP
                if (!$historic->user->vips->where('user_id', '=', $historic->user->id)->first()) {
                    if ($historic->real_downloaded > ($historic->torrent->size * 3 / 100)) {
                        //TODO finish this
                    }
                }
            }
        }
    }
}
