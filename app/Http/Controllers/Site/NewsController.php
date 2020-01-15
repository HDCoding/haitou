<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, $slug)
    {
        $new = News::where('id', '=', $id)->whereSlug($slug)->firstOrFail();
        $new->increment('views');

        return view('site.news.new', compact('new'));
    }
}
