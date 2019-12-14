<?php

namespace App\Helpers;

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class BlacklistUpdater
{
    public static function update()
    {
        $url = config('email-blacklist.email.source');
        if ($url === null) {
            return false;
        }
        // Define parameters for the cache
        $key = config('email-blacklist.email.cache-key', 'email.domains.blacklist');
        $duration = Carbon::now()->addMonth();

        $domains = json_decode(file_get_contents($url), true);
        $count = count($domains);

        // Retrieve blacklisted domains
        Cache::put($key, $domains, $duration);

        return $count;
    }
}
