<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function show($id, $slug)
    {
        $new = News::where('id', '=', $id)->whereSlug($slug)->firstOrFail();
        $new->increment('views');

        return view('site.news.new', compact('new'));
    }
}
