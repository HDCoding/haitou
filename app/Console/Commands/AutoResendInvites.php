<?php

namespace App\Console\Commands;

use App\Jobs\SendInvitationJob;
use App\Models\Invitation;
use App\Notifications\ResendInviteNotification;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoResendInvites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-resend-invites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Resend not accepted invitation after X days created_at.';

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
        $current = new Carbon();
        $invites = Invitation::with('user:id,username')
            ->whereNull('accepted_at')
            ->whereNull('accepted_by')
            ->whereNull('resend_at')
            ->where('created_at', '<', $current->copy()->subDays(2)->toDateTimeString())
            ->get();

        foreach ($invites as $invite) {
            //set resend datetime
            $invite->resend_at = now();
            //resend email
            dispatch(new SendInvitationJob($invite));
            //save
            $invite->save();
            //send notification
            $invite->user->notify(new ResendInviteNotification());
        }
    }
}
