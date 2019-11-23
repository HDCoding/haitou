<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\MediasRequest;
use App\Models\Actor;
use App\Models\Category;
use App\Models\Character;
use App\Models\Genre;
use App\Models\Media;
use App\Models\MediaCast;
use App\Models\Studio;
use Illuminate\Http\Request;

class MediasController extends Controller
{
    public function index()
    {
        $medias = Media::with(['category:id,name', 'studio:id,name'])
            ->select('id', 'category_id', 'studio_id', 'name', 'media_type', 'poster', 'views')->get();
        return view('staff.medias.index', compact('medias'));
    }

    public function create()
    {
        $categories = Category::where('is_media', '=', true)->pluck('name', 'id');
        $studios = Studio::all()->pluck('name', 'id');
        $genres = Genre::all()->pluck('name', 'id');
        return view('staff.medias.add', compact('categories', 'studios', 'genres'));
    }

    public function store(MediasRequest $request)
    {
        $media = new Media($request->except('_token'));
        $media->save();
        $media->genres()->attach($request->input('genre_id'));
        toastr()->success('Nova midia cadastrada.', 'Sucesso');
        return redirect()->to('staff/medias');
    }

    public function edit($media_id)
    {
        $media = Media::findOrFail($media_id);
        $categories = Category::where('is_media', '=', true)->pluck('name', 'id');
        $studios = Studio::all()->pluck('name', 'id');
        $genres = Genre::all()->pluck('name', 'id');
        $genre = $media->genres()->where('media_id', $media->id)->get();
        return view('staff.medias.edit', compact('media', 'categories', 'studios', 'genres', 'genre'));
    }

    public function update(MediasRequest $request, $media_id)
    {
        $media = Media::findOrFail($media_id);
        $media->update($request->except('_token'));
        $media->genres()->sync($request->input('genre_id'));
        toastr()->info('Midia atualizada.', 'Sucesso');
        return redirect()->to('staff/medias');
    }

    public function destroy($media_id)
    {
        Media::findOrFail($media_id)->delete();
        toastr()->warning('Midia deletada.', 'Aviso');
        return redirect()->to('staff/medias');
    }

    public function casts($media_id)
    {
        $casts = MediaCast::where('media_id', '=', $media_id)->get();
        $actors = Actor::select('id', 'name')->get();
        $characters = Character::select('id', 'name')->get();
        $media = $media_id;
        return view('staff.medias.casts', compact('casts', 'actors', 'characters', 'media'));
    }

    public function castSave(Request $request, $media_id)
    {
        $character = $request->input('character_id');
        $actor = $request->input('actor_id');

        if ($character == 0 && $actor == 0) {
            toastr()->error('Um dos campos não pode estar vazio', 'Erro');
            return redirect()->back();
        }

        $cast = new MediaCast();
        $cast->media_id = $media_id;
        $cast->character_id = $character !== 0 ? $character : null;
        $cast->actor_id = $actor !== 0 ? $actor : null;
        $cast->save();

        return redirect()->back();
    }

    public function castDelete($cast_id)
    {
        MediaCast::findOrFail($cast_id)->delete();
        toastr()->warning('Cast deletada.', 'Aviso');
        return redirect()->back();
    }
}
