<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;

trait UsersOnline
{
    public function allOnline()
    {
        return $this->all()->filter->isOnline();
    }

    public function isOnline()
    {
        if (!$this->last_action) {
            return false;
        }

        return $this->last_action->gt(now()->subMinutes(5));
    }

    public function leastRecentOnline()
    {
        return $this->allOnline()->sortBy(function ($user) {
            return $user->getCacheNow();
        });
    }

    public function mostRecentOnline()
    {
        return $this->allOnline()->sortByDesc(function ($user) {
            return $user->getCacheNow();
        });
    }

    public function getCacheNow()
    {
        if (empty($cache = Cache::get($this->getCacheKey()))) {
            return 0;
        }

        return $cache['now'];
    }

    public function setCache($seconds = 300)
    {
        return Cache::put($this->getCacheKey(), $this->getCacheContent(), $seconds);
    }

    public function getCacheContent()
    {
        if (!empty($cache = Cache::get($this->getCacheKey()))) {
            return $cache;
        }

        return [
            'now' => now(),
            'user' => $this
        ];
    }

    public function pullCache()
    {
        Cache::pull($this->getCacheKey());
    }

    public function getCacheKey()
    {
        return sprintf('%s-%s', 'UserOnline', $this->id);
    }
}
