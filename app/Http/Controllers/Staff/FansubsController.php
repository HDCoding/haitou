<?php

namespace App\Http\Controllers\Staff;

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
        $this->middleware('allow:fansubs-mod');
    }

    public function index()
    {
        $fansubs = Fansub::with('torrents:id')->select('id', 'name', 'logo', 'views')->get();
        return view('staff.fansubs.index', compact('fansubs'));
    }

    public function create()
    {
        return view('staff.fansubs.create');
    }

    public function store(FansubsRequest $request)
    {
        $fansub = new Fansub($request->except('_token'));
        $fansub->save();
        toastr()->success('Novo fansub cadastrado.', 'Sucesso');
        return redirect()->to('staff/fansubs');
    }

    public function edit($fansub_id)
    {
        $fansub = Fansub::findOrFail($fansub_id);
        return view('staff.fansubs.edit', compact('fansub'));
    }

    public function update(FansubsRequest $request, $fansub_id)
    {
        Fansub::findOrFail($fansub_id)->update($request->except('_token'));
        toastr()->info('Fansub atualizado.', 'Sucesso');
        return redirect()->to('staff/fansubs');
    }

    public function destroy($fansub_id)
    {
        Fansub::findOrFail($fansub_id)->delete();
        toastr()->warning('Fansub deletado.', 'Sucesso');
        return redirect()->to('staff/fansubs');
    }

    public function members($fansub_id)
    {
        $fansub = Fansub::findOrFail($fansub_id);
        $members = FansubUser::with('user:id,username')->where('fansub_id', '=', $fansub_id)->get();
        $users = User::select(['id', 'username'])->where('status', '=', 2)->pluck('username', 'id');
        return view('staff.fansubs.members', compact('fansub', 'members', 'users'));
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

        return redirect()->to('staff/fansub/' . $fansub_id . '/members');
    }

    public function delMembers($member_id)
    {
        FansubUser::findOrFail($member_id)->delete();
        toastr()->warning('Membro deletado do fansub.', 'Aviso');
        return redirect()->back();
    }
}
