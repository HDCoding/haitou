<?php

namespace App\Console\Commands;

use App\Models\Calendar;
use Illuminate\Console\Command;

class AutoRecycleCalendars extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-recycle-calendars';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Disable Old Calendar Events After End of the Date';

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
        $calendars = Calendar::where('end_date', '<', $current)->get();

        foreach ($calendars as $calendar) {
            $calendar->is_enabled = false;
            $calendar->update();
        }
    }
}
