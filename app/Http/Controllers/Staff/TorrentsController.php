<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Torrent\UpdateRequest;
use App\Models\Category;
use App\Models\Fansub;
use App\Models\Media;
use App\Models\Torrent;
use Illuminate\Support\Facades\Storage;

class TorrentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:torrents-mod');
    }

    public function index()
    {
        $torrents = Torrent::with(['category:id,name'])
            ->select('id', 'category_id', 'name', 'size', 'views', 'is_freeleech', 'is_silver', 'is_doubleup')
            ->get();
        return view('staff.torrents.index', compact('torrents'));
    }

    public function edit($torrent_id)
    {
        $torrent = Torrent::findOrFail($torrent_id);
        $categories = Category::where('is_torrent', '=', true)->pluck('name', 'id');
        $medias = Media::all()->pluck('name', 'id');
        $fansubs = Fansub::all()->pluck('name', 'id');
        return view('staff.torrents.edit', compact('torrent', 'categories', 'medias', 'fansubs'));
    }

    public function update(UpdateRequest $request, $torrent_id)
    {
        if ($request->get('silver') && $request->get('freeleech')) {
            toastr()->error('Silver e Freeleech dão conflito, escolha apenas 1.', 'Erro');
            return redirect()->back()->withInput();
        }

        $torrent = Torrent::findOrFail($torrent_id);
        $torrent->update($request->except('token'));

        toastr()->info('Torrent atualizado.', 'Sucesso');
        return redirect()->to('staff/torrents');
    }

    public function destroy($torrent_id)
    {
        Torrent::findOrFail($torrent_id)->delete();
        Storage::disk('torrents')->delete("{$torrent_id}.torrent");
        toastr()->warning('Torrent deletado.', 'Aviso');
        return redirect()->to('staff/torrents');
    }

    public function freeleech($torrent_id)
    {
        $torrent = Torrent::findOrFail($torrent_id);
        $torrent->is_freeleech = !$torrent->is_freeleech;
        if ($torrent->is_silver == true) {
            $torrent->is_silver = false;
        }
        $torrent->update();

        toastr()->info('Torrent agora é Freeleech.', 'Sucesso');
        return redirect()->to('staff/torrents');
    }

    public function silver($torrent_id)
    {
        $torrent = Torrent::findOrFail($torrent_id);
        $torrent->is_silver = !$torrent->is_silver;
        if ($torrent->is_freeleech == true) {
            $torrent->is_freeleech = false;
        }
        $torrent->update();
        toastr()->info('Torrent agora é Silver.', 'Sucesso');
        return redirect()->to('staff/torrents');
    }

    public function doubleup($torrent_id)
    {
        $torrent = Torrent::findOrFail($torrent_id);
        $torrent->is_doubleup = !$torrent->is_doubleup;
        $torrent->update();
        toastr()->info('Torrent agora é DoubleUP.', 'Sucesso');
        return redirect()->to('staff/torrents');
    }
}
