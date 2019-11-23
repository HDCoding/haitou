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
    public function show($media_id, $slug)
    {
        $media = Media::where('id', '=', $media_id)->whereSlug($slug)->firstOrFail();
        $media->increment('views');

        $comments = $media->comments()->latest()->paginate(5);

        if (request()->ajax()) {
            return view('layouts.includes.comment_layout', compact('comments'));
        }

        $user_id = auth()->user()->id;
        $voted = Rating::where('media_id', '=', $media->id)->where('user_id', '=', $user_id)->first();
        $bookmarked = Bookmark::where('media_id', '=', $media->id)->where('user_id', '=', $user_id)->first();

        return view('site.medias.media', compact('media', 'comments', 'voted', 'bookmarked'));
    }

    public function vote(RatingRequest $request, $media_id)
    {
        $media = Media::findOrFail($media_id);

        $user = $request->user();

        $vote = $request->input('vote');

        $voted = Rating::where('media_id', '=', $media->id)->where('user_id', '=', $user->id)->first();

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
