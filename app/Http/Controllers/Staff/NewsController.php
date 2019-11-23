<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\NewsRequest;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $news = News::with('user:id,name')
            ->select('id', 'user_id', 'username', 'views')
            ->orderBy('id', 'DESC')->get();
        return view('staff.news.index', compact('news'));
    }

    public function create()
    {
        return view('staff.news.add');
    }

    public function store(NewsRequest $request)
    {
        $new = new News($request->except('_token'));
        $new->staff_id = auth()->user()->id;
        $new->save();
        toastr()->success('News cadastrada.', 'Sucesso');
        return redirect()->to('staff/news');
    }

    public function edit($news_id)
    {
        $new = News::findOrFail($news_id);
        return view('staff.news.edit', compact('new'));
    }

    public function update(NewsRequest $request, $news_id)
    {
        $new = News::findOrFail($news_id);
        $new->staff_id = auth()->user()->id;
        $new->update($request->except('_token'));
        toastr()->info('News atualizada.', 'Sucesso');
        return redirect()->to('staff/news');
    }

    public function destroy($news_id)
    {
        News::findOrFail($news_id)->delete();
        toastr()->warning('News deletada.', 'Aviso');
        return redirect()->to('staff/news');
    }
}
