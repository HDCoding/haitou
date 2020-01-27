<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Group;
use App\Models\Login;
use App\Models\News;
use App\Models\Poll;
use App\Models\Post;
use App\Models\Topic;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // For Cache
        $expire_at = Carbon::now()->addMinutes(5);

        // Latest News
        $news = cache()->remember('latest_news', $expire_at, function () {
            return News::select(['id', 'name', 'slug', 'created_at'])->latest()->take(5)->get();
        });

        // Latest Topics
        $topics = cache()->remember('latest_topics', $expire_at, function () {
            return Topic::with('forum')->latest()->take(5)->get();
        });

        // Latest Posts
        $posts = cache()->remember('latest_posts', $expire_at, function () {
            return Post::with('topic', 'user')->latest()->take(5)->get();
        });

        // Latest Poll
        $polls = cache()->remember('latest_polls', $expire_at, function () {
            return Poll::select('id', 'name', 'slug', 'created_at')
                ->where('is_main', '=', true)
                ->where('is_closed', '=', false)
                ->latest()->take(5)->get();
        });

        // Users Online
        $logins = Login::with('user:id,group_id,username,slug,is_warned,show_profile')
            ->where('created_at', '>', now()->subMinutes(10))
            ->get();

        // Groups
        $groups = cache()->remember('user_groups', $expire_at, function () {
            return Group::select(['name', 'color', 'icon'])->oldest('id')->get();
        });

        return view('site.home.index', [
            'news' => $news,
            'topics' => $topics,
            'posts' => $posts,
            'polls' => $polls,
            'logins' => $logins,
            'groups' => $groups,
        ]);
    }

}
