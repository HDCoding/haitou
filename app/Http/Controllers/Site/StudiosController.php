<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Studio;

class StudiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($studio_id, $slug)
    {
        $studio = Studio::where('id', '=', $studio_id)->whereSlug($slug)->firstOrFail();
        $studio->increment('views');

        $comments = $studio->comments()->latest()->paginate(5);

        if (request()->ajax()) {
            return view('includes.comments', compact('comments'));
        }

        return view('site.studios.studio', compact('studio', 'comments'));
    }
}
