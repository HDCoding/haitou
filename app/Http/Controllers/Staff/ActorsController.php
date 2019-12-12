<?php

namespace App\Http\Controllers\Staff;

use App\Helpers\ImageUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\ActorsRequest;
use App\Models\Actor;
use Illuminate\Http\Request;

class ActorsController extends Controller
{
    protected $imageFile;

    public function __construct()
    {
        $this->middleware('auth');
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
        $img = $request->file('image');
        $filename = md5_gen() . '.' . $img->getClientOriginalExtension(); //recebe nome aleatório e a extensão do arquivo
        //End Image

        $actor->image = $filename;
        $actor->website = $request->input('website');
        $actor->description = $request->input('description');
        $actor->birthday = $request->input('birthday');
        $actor->save();

        //upload da imagem
        $this->imageFile->uploadImage(Actor::uploaderFolder, $filename, $img);

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
        $img = $request->file('image');
        if ($img != null) {
            $this->imageFile->removeImage(Actor::uploaderFolder, $actor->image); //remove a imagem antiga
            $filename = md5_gen() . '.' . $img->getClientOriginalExtension(); //recebe nome aleatório e a extensão do arquivo
        } else {
            $filename = $actor->image; //se o usuario nao atualizar a imagem o nome e extensão continua igual
        }
        //End Image

        $actor->image = $filename;
        $actor->website = $request->input('website');
        $actor->description = $request->input('description');
        $actor->birthday = $request->input('birthday');
        $actor->update();

        if ($img != null) {
            $this->imageFile->uploadImage(Actor::uploaderFolder, $filename, $img); //upload da imagem
        }

        toastr()->info('Atriz/Ator atualizada(o).', 'Sucesso');
        return redirect()->to('staff/actors');
    }

    public function destroy($actor_id)
    {
        $actor = Actor::findOrFail($actor_id);
        //$this->imageFile->removeImage(Actor::uploaderFolder, $actor->image);
        $actor->delete();

        toastr()->warning('Atriz/Ator deletada(o).', 'Aviso');
        return redirect()->to('staff/actors');
    }
}
