<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\PollsRequest;
use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;

class PollsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $polls = Poll::with('user:id,username,slug')
            ->where('is_main', '=', false)
            ->latest() //Order by Last created
            ->get();

        return view('site.polls.index', compact('polls'));
    }

    public function create()
    {
        return view('site.polls.create');
    }

    public function store(PollsRequest $request)
    {
        $user = $request->user();

        $data = $request->except('_token');
        $data['user_id'] = $user->id;
        $data['is_main'] = false;

        $poll = new Poll($data);
        $poll->save();

        foreach ($data['options'] as $key => $value) {
            Option::create(['poll_id' => $poll->id, 'name' => $value]);
        }

        toastr()->success('Nova pesquisa cadastrada.', 'Pesquisa!');
        return redirect()->to('polls');
    }

    public function show(Request $request, $poll_id, $slug)
    {
        //logged user
        $user = $request->user();

        $poll = Poll::where('id', '=', $poll_id)
            ->whereSlug($slug)
            ->firstOrFail();

        if ($poll->hasVoted($user->id)) {
            toastr()->info('Você já votou nesta enquete. Aqui estão os resultados.', 'Enquete');
            return redirect()->route('site.poll.results', ['id' => $poll->id, 'slug' => $poll->slug]);
        }

        //increment views
        $poll->increment('views');

        return view('site.polls.poll', compact('poll'));
    }

    public function vote(Request $request, $poll_id, $slug)
    {
        $poll = Poll::whereSlug($slug)->findOrFail($poll_id);

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

        toastr()->info('O seu voto foi computado.', 'Enquete');
        return redirect()->route('site.poll.results', [$poll->id, $poll->slug]);
    }

    public function result($poll_id, $slug)
    {
        $poll = Poll::where('id', '=', $poll_id)
            ->whereSlug($slug)
            ->firstOrFail();

        $totalVotes = $poll->totalVotes();

        return view('site.polls.result', compact('poll', 'totalVotes'));
    }
}
