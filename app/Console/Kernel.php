<?php

namespace App\Console;

use App\Console\Commands\EnsureQueueListenerIsRunning;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        EnsureQueueListenerIsRunning::class
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('queue:checkup')->everyFiveMinutes();
        $schedule->command('haitou:auto-ban')->daily(); //Ban User If Has More Than X Active Warnings.
        $schedule->command('haitou:auto-birthday-gift')->daily(); //Automatically gives gift to user on they special day.
        $schedule->command('haitou:auto-birthday-restore')->yearly(); //Automatically restore gifted users to false every new Year.
        $schedule->command('haitou:auto-deactivate-suspended')->daily(); //Automatically Deactivates User Warnings If Expired.
        $schedule->command('haitou:auto-deactivate-warning')->daily(); //Automatically Deactivates User Warnings If Expired.
        $schedule->command('haitou:auto-flush-peers')->hourly();
        $schedule->command('haitou:auto-group')->daily();
        // $schedule->command('haitou:auto-hit-and-run')->daily();
        // $schedule->command('haitou:auto-pre-hit-and-run')->daily();
        $schedule->command('haitou:auto-recycle-accounts')->monthly(); //Recycle Non-Activated Account With More 30 Days Old.
        $schedule->command('haitou:auto-recycle-calendars')->daily(); //Disable Old Calendar Events After End of the Date.
        $schedule->command('haitou:auto-recycle-cheaters')->monthly(); //Recycle Cheaters Table Once 30 Days Old.
        $schedule->command('haitou:auto-recycle-failed-logins')->daily(); //Recycle Failed Logins Once 30 Days Old.
        $schedule->command('haitou:auto-recycle-invites')->daily(); //Recycle Invites That Are Expired.
        $schedule->command('haitou:auto-recycle-vips')->daily(); //Automatically Removes A Users Vips If It Has Expired.
        $schedule->command('haitou:auto-resend-invites')->daily(); //Resend not accepted invitation after X days created_at.
        $schedule->command('haitou:auto-sync-peers')->daily();
        //$schedule->command('haitou:clear-all-cache')->daily();
        $schedule->command('haitou:email-blacklist-update')->monthly(); //Update cache for email domains blacklist.
        //$schedule->command('haitou:set-all-cache')->daily();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
