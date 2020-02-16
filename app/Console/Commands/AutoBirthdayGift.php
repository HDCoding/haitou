<?php

namespace App\Console\Commands;

use App\Notifications\BirthdayGiftNotification;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AutoBirthdayGift extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-birthday-gift';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically gives gift to user on they special day.';

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
        //select users from DB
        $users = User::with('logs')
            ->select('id', 'points', 'experience', 'birthday', 'birth_gifted')
            ->where('birth_gifted', '=', false)
            ->get();

        foreach ($users as $user) {
            if (Carbon::parse($user->birthday)->isBirthday()) {
                //Save changes
                $user->points += 1000;
                $user->experience += 1000;
                $user->birth_gifted = 1;
                $user->update();

                //Save in log for futures complains
                $user->logs()->create([
                    'user_id' => $user->id,
                    'content' => 'Recebeu presente de aniversario',
                    'ip' => '127.0.0.1'
                ]);

                //Notifica do presente
                $user->notify(new BirthdayGiftNotification());
            }
        }
    }
}
