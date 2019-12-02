<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\CategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function __construct()
    {
//        $this->middleware('auth');
    }

    public function index()
    {
        $categories = Category::orderBy('name', 'ASC')
            ->select('id', 'name', 'color', 'icon', 'is_faq', 'is_forum', 'is_media', 'is_torrent', 'position', 'views')
            ->get();
        return view('staff.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('staff.categories.create');
    }

    public function store(CategoriesRequest $request)
    {
        $category = new Category();
        $category->name = $request->input('name');
        $category->color = $request->input('color');
        $category->icon = $request->input('icon');

        $class = $request->input('class');

        if ($class == 1) {
            $category->is_faq = true;
        } elseif ($class == 2) {
            $category->is_forum = true;
        } elseif ($class == 3) {
            $category->is_media = true;
        } else {
            $category->is_torrent = true;
        }
        $category->save();

        toastr()->success('Nova categoria cadastrada.', 'Sucesso');
        return redirect()->to('staff/categories');
    }

    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        return view('staff.categories.edit', compact('category'));
    }

    public function update(CategoriesRequest $request, $category_id)
    {
        $category = Category::findOrFail($category_id);
        $category->update($request->except('_token'));
        toastr()->info('Categoria atualizada.', 'Sucesso');
        return redirect()->to('staff/categories');
    }

    public function destroy($category_id)
    {
        Category::findOrFail($category_id)->delete();
        toastr()->warning('Categoria deletada.', 'Aviso');
        return redirect()->to('staff/categories');
    }

    public function order(Request $request, $id)
    {
        if ($request->ajax()) {
            DB::table('categories')
                ->where('id', $request->get('pk'))
                ->update([$request->get('name') => $request->get('value')]);
            return response()->json(['success' => 'Posicao atualizada.'], 200);
        }
        return response()->json(['error' => 400, 'message' => 'Parametros insuficientes.'], 400);
    }
}
