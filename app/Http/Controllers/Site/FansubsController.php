<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Fansub;
use App\Models\FansubUser;
use Illuminate\Http\Request;

class FansubsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fansubs = Fansub::select('id', 'name', 'slug', 'logo')->orderBy('name', 'ASC')->get();
        return view('site.fansubs.index', compact('fansubs'));
    }

    public function show($fansub_id, $slug)
    {
        //search or fail-404
        $fansub = Fansub::where('id', '=', $fansub_id)->whereSlug($slug)->firstOrFail();
        //increment views
        $fansub->increment('views');
        //get all members
        $members = FansubUser::with('user:id,username,slug,avatar')->where('fansub_id', '=', $fansub->id)->get();
        //get all comments
        $comments = $fansub->comments()->latest()->paginate(5);
        //paginate the comments
        if (request()->ajax()) {
            return view('includes.comments', compact('comments'));
        }
        //return view
        return view('site.fansubs.fansub', compact('fansub', 'comments', 'members'));
    }
}
