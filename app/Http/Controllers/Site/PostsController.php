<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000Posts;
use App\Achievements\UserMade100Posts;
use App\Achievements\UserMade200Posts;
use App\Achievements\UserMade300Posts;
use App\Achievements\UserMade400Posts;
use App\Achievements\UserMade500Posts;
use App\Achievements\UserMade50Posts;
use App\Achievements\UserMade600Posts;
use App\Achievements\UserMade700Posts;
use App\Achievements\UserMade800Posts;
use App\Achievements\UserMadeFirstPost;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\EditTopicRequest;
use App\Http\Requests\Forum\FastPostRequest;
use App\Http\Requests\Forum\ReplyTopicRequest;
use App\Models\Post;
use App\Models\Subscription;
use App\Models\Topic;
use App\User;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /*
     * Add a Fast Post to a Topic
     */
    public function post(FastPostRequest $request, $topic_id)
    {
        $user = $request->user();
        $topic = Topic::findOrFail($topic_id);
        $forum = $topic->forum;

        //Get Permission
        $permission = $topic->forum;

        // Check if the user has permission to read the topic
        if ($permission->getPermission()->reply_topic != true || ($topic->is_locked == true && !$user->can('forum-mod'))) {
            toastr()->warning('Você não pode responder a este tópico!', 'Hey');
            return redirect()->route('forum');
        }

        $post = new Post();
        $post->forum_id = $topic->forum_id;
        $post->topic_id = $topic->id;
        $post->user_id = $user->id;
        $post->post_username = $user->username;
        $post->content = $request->input('content');
        $post->save();

        // Save last post user data to topic table
        $topic->last_post_user_id = $user->id;
        $topic->last_post_username = $user->username;
        $topic->num_post = Post::where('topic_id', '=', $topic->id)->count();
        $topic->last_reply_at = now(); // Update time
        $topic->update();

        // Count posts
        $forum->num_post = $forum->postCount($forum->id);

        // Count topics
        $forum->num_topic = $forum->topicCount($forum->id);

        // Save last post user data to the forum table
        $forum->last_post_user_id = $user->id;
        $forum->last_post_username = $user->username;

        // Save last topic data to the forum table
        $forum->last_topic_id = $topic->id;
        $forum->last_topic_name = $topic->name;
        $forum->last_topic_slug = $topic->slug;

        //Save
        $forum->update();

        //give points to user
        $points = setting('points_post');
        $user->updatePoints($points);

        // Achievements
        $this->unlockAchievementPosts($user);

        //increment number of posts
        $user->num_post += 1;
        $user->update();

        // Notify All Subscribers Of New Reply
        if ($topic->first_post_user_id != $user->id) {
            $topic->notifyFirstPoster($user, $topic, $post);
        }
        $topic->notifySubscribers($user, $topic, $post);

        //Automatic Subscribe
        $this->subscribe($request, $forum, $topic, $user);

        $appurl = "/forum/topic/{$topic->id}.{$topic->slug}?page={$post->pageNumber()}#post-{$post->id}";

        toastr()->success('Postado com sucesso', 'Post');
        return redirect()->to($appurl);
    }

    public function postEditForm($topic_id, $post_id)
    {
        $topic = Topic::findOrFail($topic_id);
        $post = Post::findOrFail($post_id);

        return view('site.forums.edit_post', compact('topic', 'post'));
    }

    public function postEdit(EditTopicRequest $request, $post_id)
    {
        $user = $request->user();
        $post = Post::with('topic:id,slug')->findOrFail($post_id);

        abort_unless($user->can('forum-mod') || $user->id === $post->user_id, 403);

        $post->content = $request->input('content');
        $post->update();

        $appurl = "/forum/topic/{$post->topic->id}.{$post->topic->slug}?page={$post->pageNumber()}#post-{$post_id}";

        toastr()->success('Postagem alterada com sucesso!!', 'Postagem');
        return redirect()->to($appurl);
    }

    public function postDelete(Request $request, $post_id)
    {
        $user = $request->user();
        $post = Post::with('topic:id,slug')->findOrFail($post_id);

        abort_unless($user->can('forum-mod') || $user->id === $post->user_id, 403);

        $post->delete();

        $points = setting('points_delete');
        $user->updatePoints($points);

        $appurl = "/forum/topic/{$post->topic->id}.{$post->topic->slug}?page={$post->pageNumber()}#post-{$post->id}";

        return redirect()->to($appurl);
    }

    public function formReply($topic_id, $post_id)
    {
        $topic = Topic::findOrFail($topic_id);
        $post = Post::findOrFail($post_id);

        return view('site.forums.reply', compact('topic', 'post'));
    }

    public function reply(ReplyTopicRequest $request, $topic_id, $post_id)
    {
        $user = $request->user();
        $topic = Topic::findOrFail($topic_id);
        $post = Post::findOrFail($post_id);
        $forum = $topic->forum;

        //Get Permission
        $permission = $topic->forum;

        // Check if the user has permission to read the topic
        if ($permission->getPermission()->reply_topic != true || ($topic->is_locked == true && !$user->can('forum-mod'))) {
            toastr()->warning('Você não pode responder a este tópico!', 'Hey');
            return redirect()->route('forum');
        }

        $reply = new Post();
        $reply->forum_id = $topic->forum_id;
        $reply->topic_id = $topic->id;
        $reply->user_id = $user->id;
        $reply->post_username = $user->username;
        $reply->content = $request->input('content');
        $reply->save();

        // Save last post user data to topic table
        $topic->last_post_user_id = $user->id;
        $topic->last_post_username = $user->username;
        $topic->num_post = Post::where('topic_id', '=', $topic->id)->count();
        $topic->last_reply_at = now(); // Update time
        $topic->update();

        // Count posts
        $forum->num_post = $forum->postCount($forum->id);

        // Count topics
        $forum->num_topic = $forum->topicCount($forum->id);

        // Save last post user data to the forum table
        $forum->last_post_user_id = $user->id;
        $forum->last_post_username = $user->username;

        // Save last topic data to the forum table
        $forum->last_topic_id = $topic->id;
        $forum->last_topic_name = $topic->name;
        $forum->last_topic_slug = $topic->slug;

        //Save
        $forum->update();

        //give points to user
        $points = setting('points_post');
        $user->updatePoints($points);

        // Achievements
        $this->unlockAchievementPosts($user);

        //increment number of posts
        $user->num_post += 1;
        $user->update();

        // Notify All Subscribers Of New Reply
        if ($topic->first_post_user_id != $user->id) {
            $topic->notifyFirstPoster($user, $topic, $post);
        }
        $topic->notifySubscribers($user, $topic, $post);
        // Notify post reply
        $topic->notifyReply($user, $post);

        //Automatic Subscribe
        $this->subscribe($request, $forum, $topic, $user);

        $appurl = "/forum/topic/{$topic->id}.{$topic->slug}?page={$post->pageNumber()}#post-{$post->id}";

        toastr()->success('Reply Postado com sucesso', 'Postagem');
        return redirect()->to($appurl);
    }

    private function unlockAchievementPosts(User $user)
    {
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
    }

    private function subscribe(Request $request, $forum, $topic, $user)
    {
        if (!$request->user()->isSubscribed($topic->id)) {
            return Subscription::create([
                'forum_id' => $forum->id,
                'topic_id' => $topic->id,
                'user_id' => $user->id
            ]);
        }
    }

}
