<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\ActorsRequest;
use App\Models\Actor;

class ActorsController extends Controller
{
    protected $imageFile;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:atores-mod');
        $this->imageFile = new ImageUploader();
    }

    public function index()
    {
        $actors = Actor::select('id', 'name', 'image', 'views')->get();
        return view('staff.actors.index', compact('actors'));
    }

    public function create()
    {
        return view('staff.actors.create');
    }

    public function store(ActorsRequest $request)
    {
        $actor = new Actor();
        $actor->name = $request->input('name');

        //Image
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = md5_gen();

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $name_file = "{$name}.{$extension}";

            // Faz o upload
            $upload = $request->image->storeAs('actors', $name_file, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/actors/nomedinamicoarquivo.extensao

            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $actor->image = $name_file;
            }
        } else {
            return redirect()->route('edit.profile')
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.')
                ->withInput();
        }

        $actor->website = $request->input('website');
        $actor->description = $request->input('description');
        $actor->birthday = $request->input('birthday');
        $actor->save();

        toastr()->success('Novo Atriz/Ator cadastrada(o).', 'Sucesso');
        return redirect()->to('staff/actors');
    }

    public function edit($actor_id)
    {
        $actor = Actor::findOrFail($actor_id);
        return view('staff.actors.edit', compact('actor'));
    }

    public function update(ActorsRequest $request, $actor_id)
    {
        $actor = Actor::findOrFail($actor_id);

        $actor->name = $request->input('name');

        //Image
        if ($request->hasFile('image') && $request->file('image')->isValid())
        {
            // Define um aleatório para o arquivo baseado no timestamps atual
            $name = md5_gen();

            // Recupera a extensão do arquivo
            $extension = $request->image->extension();

            // Define finalmente o nome
            $name_file = "{$name}.{$extension}";

            // Faz o upload
            $upload = $request->image->storeAs('actors', $name_file, 'public');
            // Se tiver funcionado o arquivo foi armazenado em storage/app/public/actors/nomedinamicoarquivo.extensao

            if (!$upload) {
                return redirect()->back()
                    ->with('error', 'Falha ao fazer upload')
                    ->withInput();
            } else {
                $actor->image = $name_file;
            }
        } else {
            return redirect()->back()
                ->with('error', 'Erro no arquivo de imagem, check o arquivo e tente novamente.')
                ->withInput();
        }
        //End Image

        $actor->website = $request->input('website');
        $actor->description = $request->input('description');
        $actor->birthday = $request->input('birthday');
        $actor->update();

        toastr()->info('Atriz/Ator atualizada(o).', 'Sucesso');
        return redirect()->to('staff/actors');
    }

    public function destroy($actor_id)
    {
        Actor::findOrFail($actor_id)->delete();

        toastr()->warning('Atriz/Ator deletada(o).', 'Aviso');
        return redirect()->to('staff/actors');
    }
}
