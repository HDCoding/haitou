<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\FansubsRequest;
use App\Models\Fansub;
use App\Models\FansubUser;
use App\User;
use Illuminate\Http\Request;

class FansubsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $fansubs = Fansub::select('id', 'name', 'slug', 'logo')->orderBy('name', 'ASC')->get();
        return view('site.fansubs.index', compact('fansubs'));
    }

    public function show($fansub_id, $slug)
    {
        //search or fail-404
        $fansub = Fansub::where('id', '=', $fansub_id)->whereSlug($slug)->firstOrFail();
        //increment views
        $fansub->increment('views');
        //get all members
        $members = FansubUser::with('user:id,username,slug,avatar')->where('fansub_id', '=', $fansub_id)->get();
        //get all comments
        $comments = $fansub->comments()->latest('id')->paginate(5);
        //paginate the comments
        if (request()->ajax()) {
            return view('includes.comments', compact('comments'));
        }
        //return view
        return view('site.fansubs.fansub', compact('fansub', 'comments', 'members'));
    }

    public function edit($fansub_id)
    {
        $fansub = Fansub::findOrFail($fansub_id);
        return view('site.fansubs.edit', compact('fansub'));
    }

    public function update(FansubsRequest $request, $fansub_id)
    {
        Fansub::findOrFail($fansub_id)->update($request->except('_token'));
        toastr()->info('Fansub atualizado.', 'Sucesso');
        return redirect()->to('fansubs');
    }

    public function members($fansub_id)
    {
        $fansub = Fansub::findOrFail($fansub_id);
        $members = FansubUser::with('user:id,username')->where('fansub_id', '=', $fansub_id)->get();
        $users = User::select(['id', 'username'])->where('status', '=', 1)->pluck('username', 'id');
        return view('site.fansubs.members', compact('fansub', 'members', 'users'));
    }

    public function addMembers(Request $request, $fansub_id)
    {
        $fansub = Fansub::find($fansub_id);

        $userId = $request->input('user_id');

        $fansub->users()->create([
            'user_id' => $userId,
            'username' => str_replace(['["', '"]'], '', User::where('id', '=', $userId)->select('username')->pluck('username')),
            'job' => $request->input('job'),
            'is_admin' => $request->input('is_admin') ? true : false
        ]);

        return redirect()->to('fansub/' . $fansub->id . '.' . $fansub->slug . '/members');
    }

    public function delMembers($member_id)
    {
        FansubUser::findOrFail($member_id)->delete();
        toastr()->warning('Membro deletado do fansub.', 'Aviso');
        return redirect()->back();
    }
}
