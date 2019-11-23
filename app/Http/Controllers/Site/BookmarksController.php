<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarksController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

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
        $user = $this->request->user();

        $bookmark = $user->bookmarks()->findOrFail($bookmark_id);

        abort_unless($bookmark->user_id == $user->id, 401);

        $bookmark->delete();

        return redirect()->back();
    }

    public function actors()
    {
        //return all logged user bookmarks
        $user = $this->request->user();

        $bookmarks = $user->bookmarks()->with('actor:id,name,slug,image')
            ->where('actor_id', '!=', null)->paginate(30);

        return view('site.bookmarks.actors', compact('bookmarks'));
    }

    public function characters(Request $request)
    {
        //return all logged user bookmarks
        $user = $this->request->user();

        $bookmarks = $user->bookmarks()->with('character:id,name,slug,image')
            ->where('character_id', '!=', null)->paginate(30);

        return view('site.bookmarks.characters', compact('bookmarks'));
    }

    public function medias(Request $request)
    {
        //return all logged user bookmarks
        $user = $this->request->user();

        $bookmarks = $user->bookmarks()->with('media:id,name,slug,poster')
            ->where('media_id', '!=', null)->paginate(30);

        return view('site.bookmarks.medias', compact('bookmarks'));
    }
}
