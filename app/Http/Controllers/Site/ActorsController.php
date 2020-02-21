<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, $actor_id, $slug)
    {
        $user = $request->user();

        $actor = Actor::where('id', '=', $actor_id)->whereSlug($slug)->firstOrFail();
        $actor->increment('views');

        $bookmarked = $user->bookmarks()->where('actor_id', '=', $actor->id)->first();

        return view('site.actors.actor', compact('actor', 'bookmarked'));
    }
}
