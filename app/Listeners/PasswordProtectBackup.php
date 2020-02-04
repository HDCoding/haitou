<?php

namespace App\Listeners;

use App\Helpers\BackupPassword;
use Spatie\Backup\Events\BackupZipWasCreated;

class PasswordProtectBackup
{
    /**
     * Handle the event.
     *
     * @param BackupZipWasCreated $event
     *
     * @return string
     */
    public function handle(BackupZipWasCreated $event)
    {
        return (new BackupPassword($event->pathToZip))->path;
    }
}
