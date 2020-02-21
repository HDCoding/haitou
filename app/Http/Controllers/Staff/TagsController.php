<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\TagsRequest;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:painel-staff');
    }

    public function index()
    {
        $tags = Tag::with('torrents:id')
            ->select('id', 'name')
            ->get();
        return view('staff.tags.index', compact('tags'));
    }

    public function store(TagsRequest $request)
    {
        $tag = new Tag($request->except('_token'));
        $tag->save();
        toastr()->success('Nova TAG cadastrada.', 'Sucesso');
        return redirect()->to('staff/tags');
    }

    public function update(Request $request, $tag_id)
    {
        if ($request->ajax()) {
            Tag::findOrFail($request->get('pk'))
                ->update([$request->input('name') => $request->input('value')]);
            return response()->json(['success' => 'TAG atulizada.'], 200);
        }
        return response()->json(['error' => 400, 'message' => 'Parametros insuficientes.'], 400);
    }

    public function destroy($tag_id)
    {
        Tag::findOrFail($tag_id)->delete();
        toastr()->warning('TAG deletada.', 'Aviso');
        return redirect()->to('staff/tags');
    }
}
