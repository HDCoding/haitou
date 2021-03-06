<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Moderator;
use App\Models\Post;
use App\Models\Topic;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        $categories = Forum::select('id', 'name')->orderBy('name')->get();

        $user = $request->user();

        $posts = $user->group->permissions->where('view_forum', '=', false)->pluck('forum_id')->toArray();
        if (!is_array($posts)) {
            $posts = [];
        }

        $topic_neos = $user->subscriptions->where('topic_id', '>', 0)->pluck('topic_id')->toArray();
        if (!is_array($topic_neos)) {
            $topic_neos = [];
        }

        if ($request->has('body') && $request->input('body') != '') {
            $logger = 'site.forums.results_posts';
            $result = Post::with(['topic', 'user'])
                ->selectRaw('posts.id as id, posts.*')
                ->leftJoin('topics', 'posts.topic_id', '=', 'topics.id')
                ->whereNotIn('topics.forum_id', $posts);
        }

        if (!isset($logger)) {
            $logger = 'site.forums.results_topics';
            $result = Topic::whereNotIn('topics.forum_id', $posts);
        }

        if ($request->has('body') && $request->input('body') != '') {
            $result->where([['posts.content', 'like', '%' . $request->input('body') . '%']]);
        }

        if ($request->has('name')) {
            $result->where([['topics.name', 'like', '%' . $request->input('name') . '%']]);
        }

        if ($request->has('subscribed') && $request->input('subscribed') == 1) {
            $result->where(function ($query) use ($topic_neos) {
                $query->whereIn('topics.id', [$topic_neos]);
            });
        } elseif ($request->has('notsubscribed') && $request->input('notsubscribed') == 1) {
            $result->whereNotIn('topics.id', $topic_neos);
        }

        if ($request->has('is_locked') && $request->input('is_locked') == 1) {
            $result->where('topics.is_locked', '=', true);
        }

        if ($request->has('is_pinned') && $request->input('is_pinned') == 1) {
            $result->where('topics.is_pinned', '=', true);
        }

        if ($request->has('body') && $request->input('body') != '') {
            if ($request->has('sorting') && $request->input('sorting') != null) {
                $sorting = "posts.{$request->input('sorting')}";
                $direction = $request->input('direction');
            } else {
                $sorting = 'posts.id';
                $direction = 'desc';
            }
            $results = $result->orderBy($sorting, $direction)->paginate(30);
        } else {
            if ($request->has('sorting') && $request->input('sorting') != null) {
                $sorting = "topics.{$request->input('sorting')}";
                $direction = $request->input('direction');
            } else {
                $sorting = 'topics.updated_at';
                $direction = 'desc';
            }
            $results = $result->orderBy($sorting, $direction)->paginate(30);
        }

        $results->setPath('?name=' . $request->input('name'));

        $params = $request->except('_token');

        return view($logger, [
            'categories' => $categories,
            'results' => $results,
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'params' => $params,
            'num_posts' => $this->stats()['num_posts'],
            'num_forums' => $this->stats()['num_forums'],
            'num_topics' => $this->stats()['num_topics'],
        ]);
    }

    public function subscriptions(Request $request)
    {
        $user = $request->user();

        $posts = $user->group->permissions->where('view_forum', '=', false)->pluck('forum_id')->toArray();
        if (!is_array($posts)) {
            $posts = [];
        }

        $topic_neos = $user->subscriptions->where('topic_id', '>', 0)->pluck('topic_id')->toArray();
        if (!is_array($topic_neos)) {
            $topic_neos = [];
        }

        $result = Forum::with('subscription_topics')
            ->selectRaw('forums.id,max(forums.position) as position, max(forums.num_topic) as num_topic, max(forums.num_post) as num_post, max(forums.name) as name, max(forums.slug) as slug, max(forums.description) as description, max(forums.created_at), max(forums.updated_at), max(topics.id) as topic_id, max(topics.created_at) as topic_created_at')
            ->leftJoin('topics', 'forums.id', '=', 'topics.forum_id')
            ->whereNotIn('topics.forum_id', $posts)
            ->where(function ($query) use ($topic_neos) {
                $query->whereIn('topics.id', $topic_neos);
            })->groupBy('forums.id');

        $results = $result->orderBy('id', 'DESC')->paginate(30);

        return view('site.forums.subscriptions', [
            'results' => $results,
            'num_posts' => $this->stats()['num_posts'],
            'num_forums' => $this->stats()['num_forums'],
            'num_topics' => $this->stats()['num_topics'],
        ]);
    }

    public function index()
    {
        $categories = Category::where('is_forum', '=', true)
            ->select('id', 'name')
            ->orderBy('position')
            ->get();

        $forums = Forum::orderBy('name')->get();

        return view('site.forums.index', [
            'categories' => $categories,
            'forums' => $forums,
            'num_posts' => $this->stats()['num_posts'],
            'num_forums' => $this->stats()['num_forums'],
            'num_topics' => $this->stats()['num_topics'],
        ]);
    }

    public function threads($forum_id, $slug)
    {
        $forum = Forum::whereSlug($slug)->findOrFail($forum_id);

        $moderators = Moderator::with('user:id,username,slug')
            ->where('forum_id', '=', $forum->id)
            ->get();

        $forum->increment('views');

        $threads = Topic::with('forum:id')
            ->where('forum_id', '=', $forum->id)
            ->latest('is_pinned')
            ->latest('last_reply_at')
            ->latest()
            ->paginate(30);

        return view('site.forums.threads', compact('forum', 'threads', 'moderators'));
    }

    public function latestTopics(Request $request)
    {
        $user = $request->user();

        $topics = $user->group->permissions->where('view_forum', '=', false)->pluck('forum_id')->toArray();
        if (!is_array($topics)) {
            $topics = [];
        }

        $results = Topic::with('forum:id,name,slug')
            ->whereNotIn('forum_id', $topics)
            ->latest('id')
            ->paginate(30);

        return view('site.forums.latest_topics', [
            'results' => $results,
            'num_posts' => $this->stats()['num_posts'],
            'num_forums' => $this->stats()['num_forums'],
            'num_topics' => $this->stats()['num_topics'],
        ]);
    }

    public function latestPosts(Request $request)
    {
        $user = $request->user();

        $posts = $user->group->permissions->where('view_forum', '=', false)->pluck('forum_id')->toArray();
        if (!is_array($posts)) {
            $posts = [];
        }

        $results = Post::with('user:id,username,slug,group_id')
            ->with('topic:id,forum_id,first_post_user_id,last_post_user_id,first_post_username,last_post_username,name,slug,is_locked,is_pinned,num_post,views,updated_at')
            ->selectRaw('posts.id as id,posts.*, views')
            ->leftJoin('topics', 'posts.topic_id', '=', 'topics.id')
            ->whereNotIn('topics.forum_id', $posts)
            ->orderBy('posts.created_at', 'desc')
            ->paginate(30);

        return view('site.forums.latest_posts', [
            'results' => $results,
            'num_posts' => $this->stats()['num_posts'],
            'num_forums' => $this->stats()['num_forums'],
            'num_topics' => $this->stats()['num_topics'],
        ]);
    }

    private function stats()
    {
        // For Cache
        $expire_at = Carbon::now()->addMinutes(10);

        return cache()->remember('forum_stats', $expire_at, function () {
            return [
                'num_forums' => Forum::count(), // Total Forums Count
                'num_posts' => Post::count(), // Total Posts Count
                'num_topics' => Topic::count() // Total Topics Count
            ];
        });
    }
}
