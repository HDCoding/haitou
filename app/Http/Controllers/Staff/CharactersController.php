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
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = md5_gen();

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $name_file = "{$name}.{$extension}";

            // Faz o upload
            $upload = $request->image->storeAs('characters', $name_file, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/characters/nomedinamicoarquivo.extensao

            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $character->image = $name_file;
            }
        } else {
            return redirect()->back()
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.')
                ->withInput();
        }
        //End Image

        $character->description = $request->input('description');
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
        $character = Character::findOrFail($character_id);
        $character->name = $request->input('name');

        //Image
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = md5_gen();

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $name_file = "{$name}.{$extension}";

            // Faz o upload
            $upload = $request->image->storeAs('characters', $name_file, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/characters/nomedinamicoarquivo.extensao

            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $character->image = $name_file;
            }
        } else {
            return redirect()->back()
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.')
                ->withInput();
        }
        //End Image

        $character->description = $request->input('description');
        $character->update();

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
