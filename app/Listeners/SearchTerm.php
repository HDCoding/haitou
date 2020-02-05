<?php

namespace App\Listeners;

class SearchTerm
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        if (!request()->filled('query')) {
            return;
        }

        SearchTerm::updateOrCreate(
            ['term' => request('query')],
            ['results' => 1]
        )->increment('hits');
    }
}
