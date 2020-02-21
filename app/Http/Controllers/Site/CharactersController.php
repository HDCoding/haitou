<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Request $request, $character_id, $slug)
    {
        $user = $request->user();

        $character = Character::where('id', '=', $character_id)->whereSlug($slug)->firstOrFail();
        $character->increment('views');

        $bookmarked = $user->bookmarks()->where('character_id', '=', $character->id)->first();

        return view('site.characters.character', compact('character', 'bookmarked'));
    }
}
