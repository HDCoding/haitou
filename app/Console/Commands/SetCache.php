<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SetCache extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:set-all-cache';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets Several Common Caches.';

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
        $this->comment('Setting several common caches.');
        $this->call('view:cache');
        $this->call('route:cache');
        $this->call('config:cache');
    }
}
