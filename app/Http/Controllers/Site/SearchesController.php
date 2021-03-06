<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

class SearchesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        if ($request->isMethod('POST')) {

            $search = $request->input('search');

            $users = User::with('group:id,name')
                ->where('username', 'like', '%' . $search . '%')
                ->select('id', 'username', 'slug', 'avatar')
                ->where('status', '!=', 1)
                ->paginate(30);

            return view('site.searches.search', compact('users'));

        } else {

            toastr()->error('Erro na pesquisa', 'Erro');
            return redirect()->to('home');
        }
    }
}
