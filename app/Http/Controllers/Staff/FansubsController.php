<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\FansubsRequest;
use App\Models\Fansub;
use Illuminate\Http\Request;

class FansubsController extends Controller
{
    public function index()
    {
        $fansubs = Fansub::with('torrents:id')->select('id', 'name', 'logo', 'views')->get();
        return view('staff.fansubs.index', compact('fansubs'));
    }

    public function create()
    {
        return view('staff.fansubs.add');
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
}
