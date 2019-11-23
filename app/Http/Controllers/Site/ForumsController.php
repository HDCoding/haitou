<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000Posts;
use App\Achievements\UserMade1000Topics;
use App\Achievements\UserMade100Posts;
use App\Achievements\UserMade100Topics;
use App\Achievements\UserMade200Posts;
use App\Achievements\UserMade200Topics;
use App\Achievements\UserMade300Posts;
use App\Achievements\UserMade300Topics;
use App\Achievements\UserMade400Posts;
use App\Achievements\UserMade400Topics;
use App\Achievements\UserMade500Posts;
use App\Achievements\UserMade500Topics;
use App\Achievements\UserMade50Posts;
use App\Achievements\UserMade50Topics;
use App\Achievements\UserMade600Posts;
use App\Achievements\UserMade600Topics;
use App\Achievements\UserMade700Posts;
use App\Achievements\UserMade700Topics;
use App\Achievements\UserMade800Posts;
use App\Achievements\UserMade800Topics;
use App\Achievements\UserMade900Topics;
use App\Achievements\UserMadeFirstPost;
use App\Achievements\UserMadeFirstTopic;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\EditTopicRequest;
use App\Http\Requests\Forum\NewTopicRequest;
use App\Http\Requests\Forum\ReplyTopicRequest;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Log;
use App\Models\Moderator;
use App\Models\Post;
use App\Models\Topic;
use Illuminate\Http\Request;

class ForumsController extends Controller
{
    protected $log;

    public function __construct()
    {
        $this->log = new Log();
    }

    public function search(Request $request)
    {
        $categories = Forum::oldest('position')->get();

        $user = $request->user();

        $pests = $user->role->forum_permissions->where('view_forum', '=', 0)->pluck('forum_id')->toArray();
        if (!is_array($pests)) {
            $pests = [];
        }

        $topic_neos = $user->forum_subscriptions->where('topic_id', '>', 0)->pluck('topic_id')->toArray();
        if (!is_array($topic_neos)) {
            $topic_neos = [];
        }

        if ($request->has('body') && $request->input('body') != '') {
            $logger = 'site.forums.results_posts';
            $result = Post::selectRaw('posts.id as id,posts.*')->with(['forum_topic', 'user'])->leftJoin('forum_topics', 'forum_posts.topic_id', '=', 'forum_topics.id')->whereNotIn('forum_topics.forum_id', $pests);
        }

        if (!isset($logger)) {
            $logger = 'site.forums.results_topics';
            $result = Topic::whereNotIn('forum_topics.forum_id', $pests);
        }

        if ($request->has('body') && $request->input('body') != '') {
            $result->where([['forum_posts.content', 'like', '%' . $request->input('body') . '%']]);
        }

        if ($request->has('name')) {
            $result->where([['forum_topics.name', 'like', '%' . $request->input('name') . '%']]);
        }

        if ($request->has('subscribed') && $request->input('subscribed') == 1) {
            $result->where(function ($query) use ($topic_neos, $forum_neos) {
                $query->whereIn('topics.id', $topic_neos)->orWhereIn('topics.forum_id', $forum_neos);
            });
        } elseif ($request->has('notsubscribed') && $request->input('notsubscribed') == 1) {
            $result->whereNotIn('forum_topics.id', $topic_neos)->whereNotIn('topics.forum_id', $forum_neos);
        }

        if ($request->has('locked') && $request->input('locked') == 1) {
            $result->where('forum_topics.is_locked', '=', true);
        }

        if ($request->has('pinned') && $request->input('pinned') == 1) {
            $result->where('forum_topics.is_pinned', '=', true);
        }

        if ($request->has('body') && $request->input('body') != '') {
            if ($request->has('sorting') && $request->input('sorting') != null) {
                $sorting = "forum_posts.{$request->input('sorting')}";
                $direction = $request->input('direction');
            } else {
                $sorting = 'forum_posts.id';
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

        // Total Forums Count
        $num_forums = Forum::count();
        // Total Posts Count
        $num_posts = Post::count();
        // Total Topics Count
        $num_topics = Topic::count();

        $params = $request->all();

        return view($logger, [
            'categories' => $categories,
            'results' => $results,
            'user' => $user,
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'num_posts' => $num_posts,
            'num_forums' => $num_forums,
            'num_topics' => $num_topics,
            'params' => $params,
        ]);
    }

    public function subscriptions(Request $request)
    {
        $user = $request->user();

        $pests = $user->role->forum_permissions->where('view_forum', '=', 0)->pluck('forum_id')->toArray();
        if (!is_array($pests)) {
            $pests = [];
        }

        $topic_neos = $user->forum_subscriptions->where('topic_id', '>', '0')->pluck('topic_id')->toArray();
        if (!is_array($topic_neos)) {
            $topic_neos = [];
        }

        //TODO
        //remove forum_id
        $result = Forum::with('subscriptions')->selectRaw('forums.id,max(forums.position) as position,max(forums.num_topic) as num_topic,max(forums.num_post) as num_post,max(forums.last_topic_id) as last_topic_id,max(forums.last_topic_name) as last_topic_name,max(forums.last_topic_slug) as last_topic_slug,max(forums.last_post_user_id) as last_post_user_id,max(forums.last_post_user_username) as last_post_user_username,max(forums.name) as name,max(forums.slug) as slug,max(forums.description) as description,max(forums.parent_id) as parent_id,max(forums.created_at),max(forums.updated_at),max(topics.id) as topic_id,max(topics.created_at) as topic_created_at')->leftJoin('forum_topics', 'forums.id', '=', 'forum_topics.forum_id')->whereNotIn('forum_topics.forum_id', $pests)->where(function ($query) use ($topic_neos, $forum_neos) {
            $query->whereIn('forum_topics.id', $topic_neos)->orWhereIn('forums.id', $forum_neos);
        })->groupBy('forums.id');

        $results = $result->orderBy('created_at', 'desc')->paginate(30);
        $results->setPath('?name=' . $request->input('name'));

        // Total Forums Count
        $num_forums = Forum::count();
        // Total Posts Count
        $num_posts = Post::count();
        // Total Topics Count
        $num_topics = Topic::count();

        $params = $request->all();

        return view('site.forums.subscriptions', [
            'results' => $results,
            'user' => $user,
            'name' => $request->input('name'),
            'body' => $request->input('body'),
            'num_posts' => $num_posts,
            'num_forums' => $num_forums,
            'num_topics' => $num_topics,
            'params' => $params,
            'forum_neos' => $forum_neos,
            'topic_neos' => $topic_neos,
        ]);
    }

    public function index()
    {
        $categories = Category::with('forums')
            ->where('is_forum', '=', true)
            ->orderBy('position', 'ASC')->get();


        // Total Forums Count
        $num_forums = Forum::count();
        // Total Posts Count
        $num_posts = Post::count();
        // Total Topics Count
        $num_topics = Topic::count();

        return view('site.forums.index', compact('categories', 'num_forums', 'num_posts', 'num_topics'));
    }

    public function topics($forum_id, $slug)
    {
        $forum = Forum::findOrFail($forum_id);
        $moderators = Moderator::all();
        $forum->increment('views');

        $topics = $forum->forum_topics()->latest('is_pinned')->latest('id')->paginate(30);

        return view('site.forums.topics', compact('forum', 'topics', 'moderators'));
    }

    public function topic($topic_id, $slug)
    {
        //Find the topic
        $topic = Topic::findOrFail($topic_id);

        //Get Permission
        $permission = $topic->forum;

        // Check if the user has permission to read the topic
        if ($permission->getPermission()->read_topic != true) {
            toastr()->warning('Você não tem acesso para ler este tópico', 'Hey');
            return redirect()->route('forum');
        }

        // First post
        $firstPost = Post::where('topic_id', '=', $topic->id)->first();

        //Get all posts
        $posts = $topic->posts()->with('user:id,slug,name,signature,avatar,mood_id,created_at')->paginate(30);

        //Increment view
        $topic->increment('views');

        return view('site.forums.topic', compact('topic', 'posts', 'firstPost'));
    }

    /*
     * Add new Topic
     */
    public function newTopicForm($forum_id, $slug)
    {
        $forum = Forum::findOrFail($forum_id);

        // The user has the right to create a topic here?
        if ($forum->getPermission()->start_topic != true) {
            toastr()->warning('Você não pode iniciar um novo tópico aqui!', 'Hey');
            return redirect()->route('forum');
        }

        return view('site.forums.new_topic', compact('forum'));
    }

    public function newTopicPost(NewTopicRequest $request, $forum_id)
    {
        $user = $request->user();

        $forum = Forum::findOrFail($forum_id);

        // The user has the right to create a topic here
        if ($forum->getPermission()->start_topic != true) {
            toastr()->warning('Você não pode iniciar um novo tópico aqui!', 'Hey');
            return redirect()->route('forum');
        }

        //create new topic
        $topic = new Topic();
        $topic->forum_id = $forum_id;
        $topic->first_post_user_id = $topic->last_post_user_id = $user->id;
        $topic->first_post_user_name = $topic->last_post_user_username = $user->name;
        $topic->name = $request->input('name');
        $topic->save();

        $topic->forum_posts()->create(['forum_id' => $forum_id, 'user_id' => $user->id, 'content' => $request->input('content')]);

        //give points to user
        $points = setting('points_topic');
        $user->updatePoints($points);

        // Achievements
        $user->unlock(new UserMadeFirstTopic());
        $user->addProgress(new UserMade50Topics(), 1);
        $user->addProgress(new UserMade100Topics(), 1);
        $user->addProgress(new UserMade200Topics(), 1);
        $user->addProgress(new UserMade300Topics(), 1);
        $user->addProgress(new UserMade400Topics(), 1);
        $user->addProgress(new UserMade500Topics(), 1);
        $user->addProgress(new UserMade600Topics(), 1);
        $user->addProgress(new UserMade700Topics(), 1);
        $user->addProgress(new UserMade800Topics(), 1);
        $user->addProgress(new UserMade900Topics(), 1);
        $user->addProgress(new UserMade1000Topics(), 1);

        toastr()->success('Tópico criado com sucesso!', 'Tópico');
        return redirect()->route('forum.topic', [$forum_id, $forum->slug]);
    }

    public function postEditForm($topic_id, $slug, $postId)
    {
        $topic = Topic::findOrFail($topic_id);
        $post = Post::findOrFail($postId);

        return view('site.forums.edit_post', compact('topic', 'post'));
    }

    public function postEdit(EditTopicRequest $request, $slug, $postId)
    {
        $user = $request->user();
        $post = Post::findOrFail($postId);
        $appurl = "/forum/topic/{$post->topic->id}.{$post->topic->slug}?page={$post->getPageNumber()}#post-{$postId}";

        abort_unless($user->permission->forum_mod || $user->id === $post->user_id, 403);

        $post->content = $request->input('content');
        $post->update();

        toastr()->success('Postagem alterada com sucesso!!', 'Postagem');
        return redirect()->to($appurl);
    }

    public function postDelete(Request $request, $postId)
    {
        $user = $request->user();
        $points = setting('points_delete');

        $post = Post::with('forum_topic')->findOrFail($postId);

        abort_unless($user->permission->forum_mod || $user->id === $post->user_id, 403);

        $post->delete();
        $user->updatePoints($points);

        return redirect()->route('forum.topic', ['id' => $post->forum_topic->id, 'slug' => $post->forum_topic->slug]);
    }

    public function topicDelete(Request $request, $topic_id, $slug)
    {
        $user = $request->user();
        $topic = Topic::findOrFail($topic_id);

        abort_unless($user->permission->forum_mod || $user->id === $topic->first_post_user_id, 403);
        $posts = $topic->posts();
        $posts->delete();
        $topic->delete();

        toastr()->info('Este tópico foi excluído agora!', 'Tópico');
        return redirect()->route('forum.topics', ['id' => $topic->forum->id, 'slug' => $topic->forum->slug]);
    }

    /**
     * Add a Post to a Topic
     */
    public function reply(ReplyTopicRequest $request, $topic_id, $slug)
    {
        $user = $request->user();
        $topic = Topic::findOrFail($topic_id);

        //Get Permission
        $permission = $topic->forum;

        // Check if the user has permission to read the topic
        if ($permission->getPermission()->reply_topic != true || ($topic->is_locked == true && !$user->permission->forum_mod)) {
            toastr()->warning('Você não pode responder a este tópico!', 'Hey');
            return redirect()->route('forum');
        }

        $post = new Post();
        $post->forum_id = $topic->forum_id;
        $post->topic_id = $topic->id;
        $post->user_id = $user->id;
        $post->content = $request->input('content');
        $post->save();

        // Save last post user data to topic table
        $topic->last_post_user_id = $user->id;
        $topic->last_post_user_name = $user->name;
        $topic->save();

        //give points to user
        $points = setting('points_post');
        $user->updatePoints($points);

        // Achievements
        $user->unlock(new UserMadeFirstPost());
        $user->addProgress(new UserMade50Posts(), 1);
        $user->addProgress(new UserMade100Posts(), 1);
        $user->addProgress(new UserMade200Posts(), 1);
        $user->addProgress(new UserMade300Posts(), 1);
        $user->addProgress(new UserMade400Posts(), 1);
        $user->addProgress(new UserMade500Posts(), 1);
        $user->addProgress(new UserMade600Posts(), 1);
        $user->addProgress(new UserMade700Posts(), 1);
        $user->addProgress(new UserMade800Posts(), 1);
        $user->addProgress(new UserMade1000Posts(), 1);

        $appurl = "/forum/topic/{$topic->id}.{$topic->slug}?page={$post->getPageNumber()}#post-{$post->id}";

        toastr()->success('Reply Postado com sucesso', 'Postagem');
        return redirect()->to($appurl);
    }

    public function openCloseTopic(Request $request, $topic_id, $slug)
    {
        $user = $request->user();

        //Open or Close the topic
        $topic = Topic::findOrFail($topic_id);

        abort_unless($user->permission->forum_mod || $user->id === $topic->first_post_user_id, 403);

        $topic->is_locked = !$topic->is_locked;
        $topic->save();

        toastr()->success('Tópico Trancado/Aberto com sucesso', 'Tópico');
        return redirect()->route('forum.topic', ['id' => $topic->id, 'slug' => $topic->slug]);
    }

    public function pinUnpinTopic(Request $request, $topic_id, $slug)
    {
        $user = $request->user();

        //Open or Close the topic
        $topic = Topic::findOrFail($topic_id);

        abort_unless($user->permission->forum_mod || $user->id === $topic->first_post_user_id, 403);

        $topic->is_pinned = !$topic->is_pinned;
        $topic->save();

        toastr()->info('Tópico Pin/Unpin com sucesso', 'Tópico');
        return redirect()->route('forum.topic', [$topic->id, $topic->slug]);
    }

    public function latestTopics(Request $request)
    {
        $user = $request->user();

        $pests = $user->role->forum_permissions->where('view_forum', '=', 0)->pluck('forum_id')->toArray();
        if (!is_array($pests)) {
            $pests = [];
        }

        $results = Topic::whereNotIn('forum_topics.forum_id', $pests)->latest()->paginate(30);

        // Total Forums Count
        $num_forums = Forum::count();
        // Total Posts Count
        $num_posts = Post::count();
        // Total Topics Count
        $num_topics = Topic::count();

        return view('site.forums.latest_topics', [
            'results' => $results,
            'user' => $user,
            'num_posts' => $num_posts,
            'num_forums' => $num_forums,
            'num_topics' => $num_topics,
        ]);
    }

    public function latestPosts(Request $request)
    {
        $user = $request->user();

        $pests = $user->role->forum_permissions->where('view_forum', '=', 0)->pluck('forum_id')->toArray();
        if (!is_array($pests)) {
            $pests = [];
        }

        $results = Post::selectRaw('forum_posts.id as id,posts.*')->with(['forum_topic', 'user'])->leftJoin('forum_topics', 'forum_posts.topic_id', '=', 'forum_topics.id')->whereNotIn('forum_topics.forum_id', $pests)->orderBy('forum_posts.created_at', 'desc')->paginate(30);

        // Total Forums Count
        $num_forums = Forum::count();
        // Total Posts Count
        $num_posts = Post::count();
        // Total Topics Count
        $num_topics = Topic::count();

        return view('site.forums.latest_posts', [
            'results' => $results,
            'user' => $user,
            'num_posts' => $num_posts,
            'num_forums' => $num_forums,
            'num_topics' => $num_topics,
        ]);
    }
}
