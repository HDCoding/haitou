<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {

    }

    public function store()
    {

    }

    public function show($poll_id, $slug)
    {
        $user = auth()->user();

        $poll = Poll::where('id', '=', $poll_id)->whereSlug($slug)->firstOrFail();

        $totalVotes = $poll->totalVotes();

        $voted = $poll->hasVoted($user->id);

        return view('site.polls.poll', compact('poll', 'totalVotes', 'voted'));
    }

    public function vote(Request $request)
    {
        $poll_id = $request->input('poll_id');

        $user = $request->user();

        $poll = Poll::findOrFail($poll_id);

        if ($poll->hasVoted($user->id)) {
            return redirect()->route('poll.show', [$poll->id, $poll->slug])->withErrors(['Você já votou nessa pesquisa.']);
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

        return redirect()->route('poll.results', [$poll->id, $poll->slug]);
    }

    public function result($poll_id, $slug)
    {
        $poll = Poll::findOrFail($poll_id)->whereSlug($slug);
        $totalVotes = $poll->totalVotes();
        return view('site.polls.result', compact('poll', 'totalVotes'));
    }
}
