<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\PollsRequest;
use App\Models\Option;
use App\Models\Poll;
use Illuminate\Http\Request;

class PollsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:pesquisas-mod');
    }

    public function index()
    {
        $polls = Poll::with('topic:id,name')
            ->select('id', 'topic_id', 'name', 'multi_choice', 'is_main', 'is_closed', 'closed_at', 'created_at')->get();
        return view('staff.polls.index', compact('polls'));
    }

    public function create()
    {
        return view('staff.polls.create');
    }

    public function store(PollsRequest $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = $request->user()->id;

        $poll = new Poll($data);
        $poll->save();

        foreach ($data['options'] as $key => $value) {
            Option::create(['poll_id' => $poll->id, 'name' => $value]);
        }

        toastr()->success('Nova pesquisa cadastrada.', 'Sucesso');
        return redirect()->to('staff/polls');
    }

    public function show($poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        $totalVotes = $poll->totalVotes();
        return view('staff.polls.show', compact('poll', 'totalVotes'));
    }

    public function edit($poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        return view('staff.polls.edit', compact('poll'));
    }

    public function update(PollsRequest $request, $poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        $poll->update($request->except('_token'));
        toastr()->info('Pesquisa atualizada.', 'Sucesso');
        return redirect()->to('staff/polls');
    }

    public function destroy($poll_id)
    {
        Poll::findOrFail($poll_id)->delete();
        toastr()->warning('Pesquisa deletada.', 'Aviso');
        return redirect()->to('staff/polls');
    }

    public function openClose($poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        $poll->is_closed = !$poll->is_closed;
        $poll->closed_at = !empty($poll->closed_at) ? null : now();
        $poll->update();
        toastr()->info('Pesquisa Aberta/Fechada.', 'Aviso');
        return redirect()->to('staff/polls');
    }

    public function formAddOptions($poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        return view('staff.polls.options.add', compact('poll'));
    }

    public function postAddOptions(Request $request)
    {
        foreach ($request->input('options') as $key => $value) {
            Option::create(['poll_id' => $request->input('poll_id'), 'name' => $value]);
        }
        return redirect()->to('staff/polls');
    }

    public function formRemoveOptions($poll_id)
    {
        $poll = Poll::findOrFail($poll_id);
        $options = Option::where('poll_id', '=', $poll_id)->get();
        return view('staff.polls.options.remove', compact('poll', 'options'));
    }

    public function postRemoveOptions(Request $request)
    {
        if ($request->has('options')) {
            foreach ($request->input('options') as $key => $poll_id) {
                Option::findOrFail($poll_id)->delete();
            }
        }
        return redirect()->to('staff/polls');
    }
}
