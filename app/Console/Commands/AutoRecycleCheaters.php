<?php

namespace App\Console\Commands;

use App\Models\Cheater;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoRecycleCheaters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-recycle-cheaters';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recycle Cheaters Table Once 30 Days Old.';

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
        $cheaters = Cheater::where('created_at', '<', $current->copy()->subDays(30)->toDateTimeString())->get();

        foreach ($cheaters as $cheater) {
            $cheater->delete();
        }
    }
}
