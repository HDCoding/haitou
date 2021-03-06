<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000Topics;
use App\Achievements\UserMade100Topics;
use App\Achievements\UserMade200Topics;
use App\Achievements\UserMade300Topics;
use App\Achievements\UserMade400Topics;
use App\Achievements\UserMade500Topics;
use App\Achievements\UserMade50Topics;
use App\Achievements\UserMade600Topics;
use App\Achievements\UserMade700Topics;
use App\Achievements\UserMade800Topics;
use App\Achievements\UserMade900Topics;
use App\Achievements\UserMadeFirstTopic;
use App\Http\Controllers\Controller;
use App\Http\Requests\Forum\NewTopicRequest;
use App\Models\Forum;
use App\Models\Post;
use App\Models\Topic;
use App\User;
use Illuminate\Http\Request;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function topic($topic_id, $slug)
    {
        //Find the topic
        $topic = Topic::with('forum:id,name,slug')->whereSlug($slug)->findOrFail($topic_id);

        //Get Permission
        $permission = $topic->forum;

        // Check if the user has permission to read the topic
        if ($permission->getPermission()->read_topic != true) {
            toastr()->warning('Você não tem acesso para ler este tópico', 'Hey');
            return redirect()->route('forum');
        }

        //Increment view
        $topic->increment('views');

        //Get all posts
        $posts = Post::with('user:id,group_id,slug,title,signature,avatar')
            ->select('id', 'user_id', 'post_username', 'content', 'created_at')
            ->where('topic_id', '=', $topic->id)
            ->paginate(30);

        return view('site.forums.topic', compact('topic', 'posts'));
    }

    /*
     * Add new Topic
     */
    public function newTopicForm($forum_id)
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
        $forum = Forum::findOrFail($forum_id);

        $user = $request->user();

        // The user has the right to create a topic here
        if ($forum->getPermission()->start_topic != true) {
            toastr()->warning('Você não pode iniciar um novo tópico aqui!', 'Hey');
            return redirect()->route('forum');
        }

        //create new topic
        $topic = new Topic();
        $topic->forum_id = $forum_id;
        $topic->first_post_user_id = $topic->last_post_user_id = $user->id;
        $topic->first_post_username = $topic->last_post_username = $user->username;
        $topic->name = $request->input('name');
        $topic->num_post = 1;
        $topic->save();

        $topic->posts()->create([
            'forum_id' => $forum_id,
            'user_id' => $user->id,
            'post_username' => $user->username,
            'content' => $request->input('content')
        ]);

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

        $forum->update();

        //give points to user
        $points = setting('points_topic');
        $user->updatePoints($points);

        // Achievements
        $this->unlockAchievementTopics($user);

        //increment number of comment
        $user->num_topic += 1;
        $user->update();

        toastr()->success('Tópico criado com sucesso!', 'Tópico');
        return redirect()->route('forum.topic', ['topic_id' => $topic->id, 'slug' => $topic->slug]);
    }

    public function formTopicEdit(Request $request, $topic_id)
    {
        //Edit topic title
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        abort_unless($user->can('forum-mod') || $user->id !== $topic->first_post_user_id, 403);

        return view('site.forums.edit_topic', compact('topic'));
    }

    public function topicEdit(Request $request, $topic_id)
    {
        //Edit topic title
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        $forum = $topic->forum;

        abort_unless($user->can('forum-mod') || $user->id !== $topic->first_post_user_id, 403);

        $topic->name = $request->input('name');
        $topic->update();


        // Save last topic data to the forum table
        $forum->last_topic_id = $topic->id;
        $forum->last_topic_name = $topic->name;
        $forum->last_topic_slug = $topic->slug;

        $forum->update();

        toastr()->success('Título do Tópico Alterado', 'Tópico');
        return redirect()->route('forum.topic', ['topic_id' => $topic->id, 'slug' => $topic->slug]);
    }

    //TODO
    //funcao nao esta em uso, mas esta pronta/funcionando
    public function topicDelete(Request $request, $topic_id)
    {
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        abort_unless($user->can('forum-mod'), 403);

        $posts = $topic->posts();
        $posts->delete();
        $topic->delete();

        toastr()->info('Este tópico foi excluído!', 'Tópico');
        return redirect()->route('forum.threads', ['forum_id' => $topic->forum->id, 'slug' => $topic->forum->slug]);
    }

    public function openTopic(Request $request, $topic_id)
    {
        //Open the topic
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        abort_unless($user->can('forum-mod'), 403);

        $topic->is_locked = false;
        $topic->save();

        toastr()->success('Tópico Aberto com sucesso', 'Tópico');
        return redirect()->back();
    }

    public function closeTopic(Request $request, $topic_id)
    {
        //Close the topic
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        abort_unless($user->can('forum-mod'), 403);

        $topic->is_locked = true;
        $topic->save();

        toastr()->success('Tópico Trancado com sucesso', 'Tópico');
        return redirect()->back();
    }

    public function pinTopic(Request $request, $topic_id)
    {
        //Open or Close the topic
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        abort_unless($user->can('forum-mod'), 403);

        $topic->is_pinned = true;
        $topic->save();

        toastr()->info('Tópico Pin com sucesso', 'Tópico');
        return redirect()->back();
    }

    public function unpinTopic(Request $request, $topic_id)
    {
        //Open or Close the topic
        $topic = Topic::findOrFail($topic_id);

        //Logged user
        $user = $request->user();

        abort_unless($user->can('forum-mod'), 403);

        $topic->is_pinned = false;
        $topic->save();

        toastr()->info('Tópico Unpin com sucesso', 'Tópico');
        return redirect()->back();
    }



    private function unlockAchievementTopics(User $user)
    {
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
    }
}
