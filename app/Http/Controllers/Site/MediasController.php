<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RatingRequest;
use App\Models\Bookmark;
use App\Models\Media;
use App\Models\Rating;
use Illuminate\Http\Request;

class MediasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($media_id, $slug)
    {
        $media = Media::where('id', '=', $media_id)->whereSlug($slug)->firstOrFail();
        $media->increment('views'); //increment views

        $user = request()->user(); //logged user

        $comments = $media->comments()->latest('id')->paginate(5);

        if (request()->ajax()) {
            return view('includes.comments', compact('comments'));
        }

        $voted = $media->ratings()->where('user_id', '=', $user->id)->first();
        $bookmarked = $media->bookmarks()->where('user_id', '=', $user->id)->first();

        return view('site.medias.media', compact('media', 'comments', 'voted', 'bookmarked'));
    }

    public function vote(RatingRequest $request, $media_id)
    {
        $media = Media::findOrFail($media_id);

        $user = $request->user();

        $vote = $request->input('vote');

        $voted = $media->ratings()->where('user_id', '=', $user->id)->first();

        if ($voted) {
            $voted->vote = $vote;
            $voted->update();
        } else {
            $newRating = new Rating();
            $newRating->media_id = $media->id;
            $newRating->user_id = $user->id;
            $newRating->vote = $vote;
            $newRating->save();
        }
        if ($vote == 0 && !$voted) {
            return redirect()->route('media.show', [$media->id, $media->slug]);
        }

        return redirect()->route('media.show', [$media->id, $media->slug]);
    }
}
