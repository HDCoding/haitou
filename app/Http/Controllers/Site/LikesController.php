<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Post;
use App\Models\Torrent;
use Illuminate\Http\Request;

class LikesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function likeTorrent(Request $request, $torrent_id)
    {
        $torrent = Torrent::findOrFail($torrent_id);

        $user = $request->user();

        $postUrl = "torrent/{$torrent->id}.{$torrent->slug}";

        $like = $user->likes()->where('torrent_id', '=', $torrent->id)->where('is_like', '=', true)->first();
        $dislike = $user->likes()->where('torrent_id', '=', $torrent->id)->where('is_dislike', '=', true)->first();

        if ($like || $dislike) {
            toastr()->warning('Você já deu like deste torrent!', 'Aviso');
            return redirect()->to($postUrl);
        } elseif ($torrent->user_id == $user->id) {
            toastr()->info('Você não pode dar like do seu próprio torrent!', 'Aviso');
            return redirect()->to($postUrl);
        } else {
            $new = new Like();
            $new->user_id = $user->id;
            $new->torrent_id = $torrent->id;
            $new->is_like = 1;
            $new->save();

            toastr()->success('Like aplicado com sucesso!', 'Like');
            return redirect()->to($postUrl);
        }
    }

    public function dislikeTorrent(Request $request, $torrent_id)
    {
        $torrent = Torrent::findOrFail($torrent_id);

        $user = $request->user();

        $postUrl = "torrent/{$torrent->id}.{$torrent->slug}";

        $like = $user->likes()->where('torrent_id', '=', $torrent->id)->where('is_like', '=', true)->first();
        $dislike = $user->likes()->where('torrent_id', '=', $torrent->id)->where('is_dislike', '=', true)->first();

        if ($like || $dislike) {
            toastr()->warning('Você já deu dislike deste torrent!', 'Aviso');
            return redirect()->to($postUrl);
        } elseif ($torrent->user_id == $user->id) {
            toastr()->info('Você não pode dar dislike do seu próprio torrent!', 'Aviso');
            return redirect()->to($postUrl);
        } else {
            $new = new Like();
            $new->user_id = $user->id;
            $new->torrent_id = $torrent->id;
            $new->is_dislike = 1;
            $new->save();

            toastr()->success('Dislike aplicado com sucesso!', 'Dislike');
            return redirect()->to($postUrl);
        }
    }

    public function likePost(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $user = $request->user();

        $postUrl = "forum/topic/{$post->topic->id}.{$post->topic->slug}?page={$post->getPageNumber()}#post-{$post_id}";

        $like = $user->likes()->where('post_id', '=', $post->id)->where('is_like', '=', true)->first();
        $dislike = $user->likes()->where('post_id', '=', $post->id)->where('is_dislike', '=', true)->first();

        if ($like || $dislike) {
            toastr()->warning('Você já deu like deste post!', 'Aviso');
            return redirect()->to($postUrl);
        } elseif ($post->user_id == $user->id) {
            toastr()->info('Você não pode dar like do seu próprio post!', 'Aviso');
            return redirect()->to($postUrl);
        } else {
            $new = new Like();
            $new->user_id = $user->id;
            $new->post_id = $post->id;
            $new->is_like = 1;
            $new->save();

            toastr()->success('Like aplicado com sucesso!', 'Like');
            return redirect()->to($postUrl);
        }
    }

    public function dislikePost(Request $request, $post_id)
    {
        $post = Post::findOrFail($post_id);

        $user = $request->user();

        $postUrl = "forum/topic/{$post->topic->id}.{$post->topic->slug}?page={$post->getPageNumber()}#post-{$post_id}";

        $like = $user->likes()->where('post_id', '=', $post->id)->where('is_like', '=', true)->first();
        $dislike = $user->likes()->where('post_id', '=', $post->id)->where('is_dislike', '=', true)->first();

        if ($like || $dislike) {
            toastr()->warning('Você já deu dislike deste post!', 'Aviso');
            return redirect()->to($postUrl);
        } elseif ($post->user_id == $user->id) {
            toastr()->info('Você não pode dar dislike do seu próprio post!', 'Aviso');
            return redirect()->to($postUrl);
        } else {
            $new = new Like();
            $new->user_id = $user->id;
            $new->post_id = $post->id;
            $new->is_dislike = 1;
            $new->save();

            toastr()->success('Dislike aplicado com sucesso!', 'Dislike');
            return redirect()->to($postUrl);
        }
    }
}
