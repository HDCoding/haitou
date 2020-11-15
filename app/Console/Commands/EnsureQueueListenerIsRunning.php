<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EnsureQueueListenerIsRunning extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'queue:checkup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Ensure that the queue listener is running.';

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
     * @return void
     */
    public function handle()
    {
        if (!$this->isQueueListernerRunning()) {
            $this->comment('Queue listener is being started.');
            $pid = $this->startQueueListenet();
            $this->saveQueueListenerPID($pid);
        }

        $this->comment('Queue listener is running');
    }

    /**
     * Check if the queue listener is running.
     *
     * @return bool
     */
    private function isQueueListernerRunning()
    {
        if (!$pid = $this->getLastQueueListenerPID()) {
            return false;
        }

        $process = exec("ps -p $pid -opid=,cmd=");
        return !empty($process);
    }

    /**
     * Get any existing queue listener PID.
     *
     * @return bool|string
     */
    private function getLastQueueListenerPID()
    {
        if (!file_exists(__DIR__ . '/queue.pid')) {
            return false;
        }

        return file_get_contents(__DIR__ . '/queue.pid');
    }

    /**
     * Save the queue listener PID to a file.
     *
     * @param $pid
     *
     * @return void
     */
    private function saveQueueListenerPID($pid)
    {
        file_put_contents(__DIR__ . '/queue.pid', $pid);
    }

    /**
     * Start the queue listener.
     *
     * @return int
     */
    private function startQueueListenet()
    {
        $command = 'php ' . base_path() . '/artisan queue:work --timeout=60 --sleep=5 --tries=3 > /dev/null & echo $!';
        return exec($command);
    }
}
