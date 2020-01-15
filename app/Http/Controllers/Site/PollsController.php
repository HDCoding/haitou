<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollsController extends Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->middleware('auth');
        $this->request = $request;
    }

    public function show($poll_id, $slug)
    {
        $poll = Poll::where('id', '=', $poll_id)->whereSlug($slug)->firstOrFail();

        //logged user
        $user = $this->request->user();

        if ($poll->hasVoted($user->id)) {
            toastr()->info('Você já votou nesta enquete. Aqui estão os resultados.', 'Enquete');
            return redirect()->route('site.poll.results', ['id' => $poll->id, 'slug' => $poll->slug]);
        }

        //increment views
        $poll->increment('views');

        return view('site.polls.poll', compact('poll'));
    }

    public function vote($poll_id, $slug, Request $request)
    {
        $poll = Poll::findOrFail($poll_id)->whereSlug($slug);

        $user = $request->user();

        if ($poll->hasVoted($user->id)) {
            toastr()->info('Você já votou nesta enquete. Aqui estão os resultados.', 'Enquete');
            return redirect()->route('site.poll.results', ['id' => $poll->id, 'slug' => $poll->slug]);
        }

        $options = $request->input('option');
        if (is_array($options)) {
            foreach ($options as $key => $option) {
                Vote::create([
                    'poll_id' => $poll->id,
                    'option_id' => $option,
                    'user_id' => $user->id
                ]);
            }
        } else {
            Vote::create([
                'poll_id' => $poll->id,
                'option_id' => $options,
                'user_id' => $user->id
            ]);
        }

        toastr()->info('O seu voto foi contado.', 'Enquete');
        return redirect()->route('site.poll.results', [$poll->id, $poll->slug]);
    }

    public function result($poll_id, $slug)
    {
        $poll = Poll::where('id', '=', $poll_id)->whereSlug($slug)->firstOrFail();
        $totalVotes = $poll->totalVotes();
        return view('site.polls.result', compact('poll', 'totalVotes'));
    }
}
