<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\CharactersRequest;
use App\Models\Character;

class CharactersController extends Controller
{
    protected $imageFile;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:personagens-mod');
        $this->imageFile = new ImageUploader();
    }

    public function index()
    {
        $characters = Character::select('id', 'name', 'image', 'views')->get();
        return view('staff.characters.index', compact('characters'));
    }

    public function create()
    {
        return view('staff.characters.create');
    }

    public function store(CharactersRequest $request)
    {
        $character = new Character();
        $character->name = $request->input('name');
        //Image
        $img = $request->file('image');
        $filename = md5_gen() . '.' . $img->getClientOriginalExtension(); //recebe nome aleatório e a extensão do arquivo
        //End Image

        $character->image = $filename;
        $character->description = $request->input('description');
        $character->save();

        //upload da imagem
        $this->imageFile->uploadImage(Character::uploaderFolder, $filename, $img);

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
        $character = Character::findOrFail($character_id);
        $character->name = $request->input('name');
        //Image
        $img = $request->file('image');
        if ($img != null) {
            $this->imageFile->removeImage(Character::uploaderFolder, $character->image); //remove a imagem antiga
            $filename = md5_gen() . '.' . $img->getClientOriginalExtension(); //recebe nome aleatório e a extensão do arquivo
        } else {
            $filename = $character->image; //se o usuario nao atualizar a imagem o nome e extensão continua igual
        }
        //End Image

        $character->image = $filename;
        $character->description = $request->input('description');
        $character->update();

        if ($img != null) {
            $this->imageFile->uploadImage(Character::uploaderFolder, $filename, $img); //upload da imagem
        }

        toastr()->info('Personagem atualizado.', 'Sucesso');
        return redirect()->to('staff/characters');
    }

    public function destroy($character_id)
    {
        $character = Character::findOrFail($character_id);
        //$this->imageFile->removeImage(Character::uploaderFolder, $character->image);
        $character->delete();

        toastr()->warning('Personagem deletado.', 'Aviso');
        return redirect()->to('staff/characters');
    }
}
