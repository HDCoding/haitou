<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function show($actor_id, $slug)
    {
        $actor = Actor::where('id', '=', $actor_id)->whereSlug($slug)->firstOrFail();
        $actor->increment('views');

        $user_id = auth()->user()->id;
        $bookmarked = Bookmark::where('actor_id', '=', $actor->id)->where('user_id', '=', $user_id)->first();

        return view('site.actors.actor', compact('actor', 'bookmarked'));
    }
}
