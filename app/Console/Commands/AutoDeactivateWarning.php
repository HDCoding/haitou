<?php

namespace App\Console\Commands;

use App\Models\Moderate;
use Illuminate\Console\Command;

class AutoDeactivateWarning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-deactivate-warning';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Deactivates User Warnings If Expired.';

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
        $warnings = Moderate::with('user,is_warned')
            ->where('is_warned', '=', 1)
            ->where('is_enabled', '=', 1)
            ->where('expires_on', '<', $current)
            ->get();

        foreach ($warnings as $warning) {
            // Set Records Active To 0 in warnings table
            $warning->is_enabled = 0;
            $warning->user->is_warned = 0;
            $warning->save();
        }
    }
}
