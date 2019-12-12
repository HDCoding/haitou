<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\StudiosRequest;
use App\Models\Studio;

class StudiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $studios = Studio::select('id', 'name', 'views')->get();
        return view('staff.studios.index', compact('studios'));
    }

    public function create()
    {
        return view('staff.studios.create');
    }

    public function store(StudiosRequest $request)
    {
        $studio = new Studio($request->except('_token'));
        $studio->save();
        toastr()->success('Novo estúdio cadastrado.', 'Sucesso');
        return redirect()->to('staff/studios');
    }

    public function edit($studio_id)
    {
        $studio = Studio::findOrFail($studio_id);
        return view('staff.studios.edit', compact('studio'));
    }

    public function update(StudiosRequest $request, $studio_id)
    {
        Studio::findOrFail($studio_id)->update($request->except('_token'));
        toastr()->info('Estúdio atulizado.', 'Sucesso');
        return redirect()->to('staff/studios');
    }

    public function destroy($studio_id)
    {
        Studio::findOrFail($studio_id)->delete();
        toastr()->warning('Estúdio deletado.', 'Aviso');
        return redirect()->to('staff/studios');
    }
}
