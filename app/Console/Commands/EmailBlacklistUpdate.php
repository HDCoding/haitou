<?php

namespace App\Console\Commands;

use App\Helpers\EmailUpdater;
use Illuminate\Console\Command;

class EmailBlacklistUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:email-blacklist-update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update cache for email domains blacklist.';

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
        $count = EmailUpdater::update();

        if ($count === false) {
            $this->warn('No domains retrieved. Check the email.blacklist.source key for validation config.');
            return;
        }
        if ($count === 0) {
            $this->info('Advice: Blacklist was retrieved from source but 0 domains were listed.');
            return;
        }
        $this->info("{$count} domains retrieved. Cache updated. You are good to go.");
    }
}
