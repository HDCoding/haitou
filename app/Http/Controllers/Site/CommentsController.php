<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000Comments;
use App\Achievements\UserMade100Comments;
use App\Achievements\UserMade200Comments;
use App\Achievements\UserMade300Comments;
use App\Achievements\UserMade400Comments;
use App\Achievements\UserMade500Comments;
use App\Achievements\UserMade50Comments;
use App\Achievements\UserMade600Comments;
use App\Achievements\UserMade700Comments;
use App\Achievements\UserMade800Comments;
use App\Achievements\UserMade900Comments;
use App\Achievements\UserMadeFirstComment;
use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\User;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $actor_id = $request->input('actor_id');
        $calendar_id = $request->input('calendar_id');
        $character_id = $request->input('character_id');
        $fansub_id = $request->input('fansub_id');
        $media_id = $request->input('media_id');
        $studio_id = $request->input('studio_id');
        $torrent_id = $request->input('torrent_id');

        if (!empty($actor_id)) {
            abort_unless($user->can('comentar-atores'), 403);
        }
        if (!empty($calendar_id)) {
            abort_unless($user->can('comentar-calendarios'), 403);
        }
        if (!empty($character_id)) {
            abort_unless($user->can('comentar-personagens'), 403);
        }
        if (!empty($fansub_id)) {
            abort_unless($user->can('comentar-fansubs'), 403);
        }
        if (!empty($media_id)) {
            abort_unless($user->can('comentar-midias'), 403);
        }
        if (!empty($studio_id)) {
            abort_unless($user->can('comentar-estudios'), 403);
        }
        if (!empty($torrent_id)) {
            abort_unless($user->can('comentar-torrents'), 403);
        }

        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->actor_id = $actor_id;
        $comment->calendar_id = $calendar_id;
        $comment->character_id = $character_id;
        $comment->fansub_id = $fansub_id;
        $comment->media_id = $media_id;
        $comment->studio_id = $studio_id;
        $comment->torrent_id = $torrent_id;
        $comment->username = $user->username;
        $comment->content = $request->input('content');
        $comment->is_spoiler = $request->input('is_spoiler') ? true : false;
        $comment->save();

        // Achievements
        $this->achievement($user);

        //give points to user
        $points = setting('points_comment');
        $user->updatePoints($points);

        //increment number of comments
        $user->num_comment += 1;
        $user->update();

        toastr()->info('Comentário Criado com Sucesso!', 'Sucesso');
        return redirect()->back();
    }

    private function achievement(User $user)
    {
        // Achievements
        $user->unlock(new UserMadeFirstComment());
        $user->addProgress(new UserMade50Comments(), 1);
        $user->addProgress(new UserMade100Comments(), 1);
        $user->addProgress(new UserMade200Comments(), 1);
        $user->addProgress(new UserMade300Comments(), 1);
        $user->addProgress(new UserMade400Comments(), 1);
        $user->addProgress(new UserMade500Comments(), 1);
        $user->addProgress(new UserMade600Comments(), 1);
        $user->addProgress(new UserMade700Comments(), 1);
        $user->addProgress(new UserMade800Comments(), 1);
        $user->addProgress(new UserMade900Comments(), 1);
        $user->addProgress(new UserMade1000Comments(), 1);
    }

    public function show(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        abort_unless($this->request->user()->id == $comment->user_id || $request->user()->can('painel-staff'), 403);

        return view('site.comments.comment', compact('comment'));
    }

    public function edit(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        abort_unless($request->user()->id == $comment->user_id || $request->user()->can('painel-staff'), 403);

        return view('site.comments.edit', compact('comment'));
    }

    public function update(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        abort_unless($request->user()->id == $comment->user_id || $request->user()->can('painel-staff'), 403);

        $comment->update($request->except('_token'));

        toastr()->success('Comentário atualizado', 'Sucesso');
        return redirect()->to('home');
    }

    public function destroy(Request $request, $comment_id)
    {
        $comment = Comment::findOrFail($comment_id);

        abort_unless($request->user()->id == $comment->user_id || $request->user()->can('painel-staff'), 403);

        $comment->delete();

        toastr()->warning('Comentário deletado', 'Aviso');
        return redirect()->to('home');
    }
}
