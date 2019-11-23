<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\ActorsRequest;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    public function index()
    {
        $actors = Actor::select('id', 'name', 'image', 'views')->get();
        return view('staff.actors.index', compact('actors'));
    }

    public function create()
    {
        return view('staff.actors.add');
    }

    public function store(ActorsRequest $request, Actor $actor)
    {
        $actor->create($request->except('_token'));
        toastr()->success('Novo Atriz/Ator cadastrada(o).', 'Sucesso');
        return redirect()->to('staff/actors');
    }

    public function edit($actor_id, Actor $actor)
    {
        $actor->findOrFail($actor_id);
        return view('staff.actors.edit', compact('actor'));
    }

    public function update(ActorsRequest $request, $actor_id, Actor $actor)
    {
        $actor->findOrFail($actor_id)->update($request->except('_token'));
        toastr()->info('Atriz/Ator atualizada(o).', 'Sucesso');
        return redirect()->to('staff/actors');
    }

    public function destroy($actor_id, Actor $actor)
    {
        $actor->findOrFail($actor_id)->delete();
        toastr()->warning('Atriz/Ator deletada(o).', 'Aviso');
    }
}
