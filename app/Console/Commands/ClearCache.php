<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ClearCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:clear-all-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clears Several Common Caches.';

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
        $this->comment('Clearing several common caches.');
        $this->call('view:clear');
        $this->call('route:clear');
        $this->call('config:clear');
    }
}
