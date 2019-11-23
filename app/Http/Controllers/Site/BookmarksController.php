<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();

        $favorite = new Bookmark();
        $favorite->user_id = $user->id;
        $favorite->character_id = $request->input('character_id');
        $favorite->actor_id = $request->input('actor_id');
        $favorite->media_id = $request->input('media_id');
        $favorite->save();

        return redirect()->back();
    }

    public function destroy($bookmark_id)
    {
        $user = auth()->user();

        $bookmark = Bookmark::findOrFail($bookmark_id);

        abort_unless($bookmark->user_id == $user->id, 401);

        $bookmark->delete();

        return redirect()->back();
    }

    public function actors(Request $request)
    {
        //return all logged user bookmarks
        $user = $request->user();

        $bookmarks = Bookmark::with('actor:id,name,slug,image')
            ->where('user_id', '=', $user->id)
            ->where('actor_id', '!=', null)->paginate(30);

        return view('site.users.bookmarks.actors', compact('bookmarks'));
    }

    public function characters(Request $request)
    {
        //return all logged user bookmarks
        $user = $request->user();

        $bookmarks = Bookmark::with('character:id,name,slug,image')
            ->where('user_id', '=', $user->id)
            ->where('character_id', '!=', null)->paginate(30);

        return view('site.users.bookmarks.characters', compact('bookmarks'));
    }

    public function medias(Request $request)
    {
        //return all logged user bookmarks
        $user = $request->user();

        $bookmarks = Bookmark::with('media:id,name,slug,poster')
            ->where('user_id', '=', $user->id)
            ->where('media_id', '!=', null)->paginate(30);

        return view('site.users.bookmarks.medias', compact('bookmarks'));
    }
}
