<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AutoBan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-ban';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ban User If Has More Than X Active Warnings.';

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
        //TODO
    }
}
