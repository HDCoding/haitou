<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\CharactersRequest;
use App\Models\Character;
use Illuminate\Http\Request;

class CharactersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $characters = Character::select('id', 'name', 'image', 'views')->get();
        return view('staff.characters.index', compact('characters'));
    }

    public function create()
    {
        return view('staff.characters.add');
    }

    public function store(CharactersRequest $request)
    {
        $character = new Character($request->except('_token'));
        $character->save();
        toastr()->success('Novo personagem cadastrada.', 'Sucesso');
        return redirect()->to('staff/characters');
    }

    public function edit($character_id)
    {
        $character = Character::findOrFail($character_id);
        return view('staff.characters.edit', compact('character'));
    }

    public function update(CharactersRequest $request, $character_id)
    {
        Character::findOrFail($character_id)->update($request->except('_token'));
        toastr()->info('Personagem atualizado.', 'Sucesso');
        return redirect()->to('staff/characters');
    }

    public function destroy($character_id)
    {
        Character::findOrFail($character_id)->delete();
        toastr()->warning('Personagem deletado.', 'Aviso');
        return redirect()->to('staff/characters');
    }
}
