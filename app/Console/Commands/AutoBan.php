<?php

namespace App\Console\Commands;

use App\Jobs\SendBannedJob;
use App\Models\Moderate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
    protected $description = 'Ban User If Has More Than 7 Active Warnings.';

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
        $warnings = Moderate::with('user:id,email,username,status,disabled_at')->select(DB::raw('user_id, count(*) as warnings'))
            ->where('is_banned', '=', false)
            ->where('is_enabled', '=', false)
            ->groupBy('user_id')
            ->having('warnings', '>=', 7)
            ->get();

        foreach ($warnings as $warning) {
            // If User Has 7 or More Active Warnings Ban Set to Banned

            $modUser = new Moderate();
            $modUser->user_id = $warning->user_id;
            $modUser->staff_id = 1;
            $modUser->title = 'Limite de advertência atingido';
            $modUser->description = 'Limite de advertência atingido, tem 7 avisos.';
            $modUser->is_banned = true;
            $modUser->save();

            DB::table('users')
                ->where('id', '=', $warning->user_id)
                ->update(['status' => 4, 'disabled_at' => now()]);

            $email = $warning->user()->email;
            $username = $warning->user()->username;

            dispatch(new SendBannedJob($email, $username));
        }
    }
}
