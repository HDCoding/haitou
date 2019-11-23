<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use App\Models\Character;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($character_id, $slug)
    {
        $character = Character::where('id', '=', $character_id)->whereSlug($slug)->firstOrFail();
        $character->increment('views');

        $user_id = auth()->user()->id;
        $bookmarked = Bookmark::where('character_id', '=', $character->id)->where('user_id', '=', $user_id)->first();

        return view('site.characters.character', compact('character', 'bookmarked'));
    }
}
