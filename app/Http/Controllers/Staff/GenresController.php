<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\GenresRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $genres = Genre::select('id', 'name', 'views')->get();
        return view('staff.genres.index', compact('genres'));
    }

    public function store(GenresRequest $request)
    {
        $genre = new Genre($request->except('_token'));
        $genre->save();
        toastr()->success('Novo genero cadastrado.', 'Sucesso');
        return redirect()->to('staff/genres');
    }

    public function update(Request $request, $genre_id)
    {
        if ($request->ajax()) {
            Genre::findOrFail($request->get('pk'))
                ->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => 'Gênero atulizado.'], 200);
        }
        return response()->json(['error' => 400, 'message' => 'Parametros insuficientes.'], 400);
    }

    public function destroy($genre_id)
    {
        Genre::findOrFail($genre_id)->delete();
        toastr()->warning('Genero deletado.', 'Aviso');
        return redirect()->to('staff/genres');
    }
}
