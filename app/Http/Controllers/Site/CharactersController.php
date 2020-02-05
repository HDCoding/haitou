<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Character;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    public function show($character_id, $slug)
    {
        $character = Character::where('id', '=', $character_id)->whereSlug($slug)->firstOrFail();
        $character->increment('views');

        $user = $this->request->user();
        $bookmarked = $user->bookmarks()->where('character_id', '=', $character->id)->first();

        return view('site.characters.character', compact('character', 'bookmarked'));
    }
}
