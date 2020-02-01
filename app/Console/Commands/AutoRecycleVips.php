<?php

namespace App\Console\Commands;

use App\Models\Vip;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoRecycleVips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'haitou:auto-recycle-vips';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically Removes A Users Vips If It Has Expired.';

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
        $vips = Vip::where('expires_on', '<', $current)->get();

        //Disable VIP on database
        foreach ($vips as $vip) {
            // Delete The Record From DB
            $vip->is_active = false;
            $vip->save();
        }

        //Update user group
        foreach ($vips as $vip) {
            DB::table('users')->where('id', '=', $vip->user_id)->update(['group_id' => 2]);
        }
    }
}
