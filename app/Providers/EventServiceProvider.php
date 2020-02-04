<?php

namespace App\Providers;

use App\Listeners\FailedLoginListener;
use App\Listeners\LoginListener;
use App\Listeners\LogoutListener;
use App\Listeners\PasswordProtectBackup;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Spatie\Backup\Events\BackupZipWasCreated;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        Failed::class => [
            FailedLoginListener::class
        ],
        Login::class => [
            LoginListener::class
        ],
        Logout::class => [
            LogoutListener::class
        ],
        BackupZipWasCreated::class => [
            PasswordProtectBackup::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
