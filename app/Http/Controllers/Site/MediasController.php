<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\RatingRequest;
use App\Models\Media;
use App\Models\Rating;

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

        $voted = Rating::with('user:id')
            ->where('user_id', '=', $user->id)
            ->where('media_id', '=', $media->id)
            ->first();

        if ($voted) {
            $voted->vote = $vote;
            $voted->update();
        } else {
            $rating = new Rating();
            $rating->media_id = $media->id;
            $rating->user_id = $user->id;
            $rating->vote = $vote;
            $rating->save();
        }

        return redirect()->route('media.show', ['id' => $media->id, 'slug' => $media->slug]);
    }
}
