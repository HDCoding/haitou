<?php

namespace App\Install;

use App\Models\Setting;

class Store
{
    public function setup($data)
    {
        Setting::setMany([
            'store_email' => $data['store_email'],
            'search_engine' => $data['search_engine'],
            'algolia_app_id' => $data['algolia_app_id'],
            'algolia_secret' => $data['algolia_secret'],
        ]);
    }
}
