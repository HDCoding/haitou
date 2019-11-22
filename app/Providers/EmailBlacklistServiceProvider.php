<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class EmailBlacklistServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Add custom validation rules
        Validator::extend("blacklist", "Haitou\Validators\EmailBlacklistValidator@validate");

        // Add custom validation messages
        Validator::replacer("blacklist", "Haitou\Validators\EmailBlacklistValidator@message");
    }
}
