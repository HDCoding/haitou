<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\GroupsRequest;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $groups = Group::all();
        return view('staff.groups.index', compact('groups'));
    }

    public function create()
    {
        return view('staff.groups.create');
    }

    public function store(GroupsRequest $request)
    {
        Group::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'color' => $request->input('color'),
            'icon' => $request->input('icon'),
            'hnr' => ($request->input('hnr') * 3600)
        ]);

        toastr()->success('Novo grupo adicionado.', 'Sucesso');
        return redirect()->to('staff/groups');
    }

    public function edit($group_id)
    {
        $group = Group::findOrFail($group_id);
        return view('staff.groups.edit', compact('group'));
    }

    public function update(GroupsRequest $request, $group_id)
    {
        $group = Group::findOrFail($group_id);
        $group->name = $request->input('name');
        $group->description = $request->input('description');
        $group->color = $request->input('color');
        $group->icon = $request->input('icon');
        $group->hnr = ($request->input('hnr') * 3600);
        $group->update();

        toastr()->info('Grupo atualizado.', 'Sucesso');
        return redirect()->to('staff/groups');
    }

    public function destroy($group_id)
    {
        Group::findOrFail($group_id)->delete();
        toastr()->warning('Grupo deletado.', 'Aviso');
        return redirect()->to('staff/groups');
    }
}
