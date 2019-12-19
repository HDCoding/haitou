<?php

namespace App\Http\Controllers\Site;

use App\Achievements\UserMade1000Uploads;
use App\Achievements\UserMade100Uploads;
use App\Achievements\UserMade200Uploads;
use App\Achievements\UserMade300Uploads;
use App\Achievements\UserMade400Uploads;
use App\Achievements\UserMade500Uploads;
use App\Achievements\UserMade50Uploads;
use App\Achievements\UserMade600Uploads;
use App\Achievements\UserMade700Uploads;
use App\Achievements\UserMade800Uploads;
use App\Achievements\UserMade900Uploads;
use App\Achievements\UserMadeFirstUpload;
use App\Helpers\TorrentUploader;
use App\Http\Controllers\Controller;
use App\Http\Requests\Torrent\UpdateRequest;
use App\Http\Requests\Torrent\UploadRequest;
use App\Models\Category;
use App\Models\Complete;
use App\Models\Fansub;
use App\Models\File;
use App\Models\Log;
use App\Models\Media;
use App\Models\Thank;
use App\Models\Torrent;
use App\Notifications\NewReseedRequestNotification;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TorrentsController extends Controller
{
    protected $log;
    protected $torrentTool;

    public function __construct()
    {
        $this->middleware('auth');
        $this->log = new Log();
        $this->torrentTool = new TorrentUploader();
    }

    public function index()
    {
        $torrents = Torrent::with('user:id,username,slug')
            ->with('fansub:id,name')
            ->with('media:id,name,poster')
            ->select('id', 'user_id', 'category_id', 'media_id', 'fansub_id', 'name',
                'slug', 'size', 'seeders', 'leechers', 'times_completed', 'is_anonymous', 'is_freeleech', 'is_silver', 'is_doubleup', 'created_at')
            ->orderBy('id', 'desc')
            ->paginate(30);

        $fansubs = Fansub::select('id', 'name')->get();

        $categories = Category::select('id', 'name')->where('is_torrent', '=', true)->get();

        return view('site.torrents.index', compact('torrents', 'fansubs', 'categories'));
    }

    public function create()
    {
        abort_unless(auth()->user()->permission->torrents_upload, 403);

        $categories = Category::where('is_torrent', '=', true)->pluck('name', 'id');
        $medias = Media::select('id', 'name')->orderBy('name', 'ASC')->pluck('name', 'id');
        $fansubs = Fansub::select('id', 'name')->pluck('name', 'id');

        return view('site.torrents.upload', compact('categories', 'medias', 'fansubs'));
    }

    public function store(UploadRequest $request)
    {
        if ($request->has('torrent') && $request->file('torrent')->isValid()) {

            $user = $request->user();

            $torrentFile = $request->file('torrent');

            $check = new TorrentUploader($torrentFile);

            if ($check->errors()) {
                toastr()->error('Erro no arquivo .torrent, recrie o arquivo e tente novamente', 'Erro');
                return redirect()->back()->withInput();
            }

            if (Torrent::where('info_hash', '=', $check->hash_info())->first()) {
                toastr()->error('Este torrent já foi feito upload.', 'Erro');
                return redirect()->back()->withInput();
            }

            if ($request->get('silver') && $request->get('freeleech')) {
                toastr()->error('Silver e Freeleech dão conflito, escolha apenas 1.', 'Erro');
                return redirect()->back()->withInput();
            }

            $torrent = new Torrent();
            $torrent->user_id = $user->id;
            $torrent->category_id = $request->input('category_id');
            $torrent->media_id = $request->input('media_id');
            $torrent->fansub_id = $request->input('fansub_id');
            $torrent->username = $user->username;
            $torrent->info_hash = $check->hash_info();
            $torrent->name = $request->input('name');
            $torrent->filename = $check->name();
            $torrent->announce = $check->one_announce();
            $torrent->description = $request->input('description');
            $torrent->size = $check->size();
            $torrent->num_files = count($check->content());
            $torrent->allow_comments = $request->input('allow_comments');
            $torrent->is_anonymous = $request->input('is_anonymous');
            $torrent->is_freeleech = $request->input('is_freeleech');
            $torrent->is_silver = $request->input('is_silver');
            $torrent->is_doubleup = $request->input('is_doubleup');
            $torrent->save();

            //give points to user
            $points = setting('points_upload');
            $user->updatePoints($points);

            foreach ($check->content() as $file => $size) {
                File::create(['torrent_id' => $torrent->id, 'size' => $size, 'name' => $file]);
            }

            $check->save($torrentFile, $torrent->id);

            // Achievements
            $user->unlock(new UserMadeFirstUpload());
            $user->addProgress(new UserMade50Uploads(), 1);
            $user->addProgress(new UserMade100Uploads(), 1);
            $user->addProgress(new UserMade200Uploads(), 1);
            $user->addProgress(new UserMade300Uploads(), 1);
            $user->addProgress(new UserMade400Uploads(), 1);
            $user->addProgress(new UserMade500Uploads(), 1);
            $user->addProgress(new UserMade600Uploads(), 1);
            $user->addProgress(new UserMade700Uploads(), 1);
            $user->addProgress(new UserMade800Uploads(), 1);
            $user->addProgress(new UserMade900Uploads(), 1);
            $user->addProgress(new UserMade1000Uploads(), 1);

            return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
        } else {
            toastr()->error('Erro no arquivo .torrent, recrie o arquivo e tente novamente', 'Erro');
            return redirect()->route('torrent.create')->withInput();
        }
    }

    public function show($torrent_id, $slug)
    {
        $torrent = Torrent::where('id', '=', $torrent_id)->whereSlug($slug)->firstOrFail();
        $torrent->increment('views');

        $comments = $torrent->comments()->latest()->paginate(5);

        if (request()->ajax()) {
            return view('layouts.includes.comment_layout', compact('comments'));
        }

        $userId = auth()->user()->id;

        $thanks = $torrent->thanks()->where('torrent_id', '=', $torrent->id)->where('user_id', '=', $userId)->first();

        $total = $torrent->thanks()->where('torrent_id', '=', $torrent->id)->count();

        return view('site.torrents.torrent', compact('torrent', 'comments', 'thanks', 'total'));
    }

    public function edit($torrent_id)
    {
        $torrent = Torrent::where('id', '=', $torrent_id)->firstOrFail();
        $categories = Category::where('is_torrent', '=', true)->pluck('name', 'id');
        $medias = Media::select('id', 'name')->orderBy('name', 'ASC')->pluck('name', 'id');
        $fansubs = Fansub::select('id', 'name')->pluck('name', 'id');

        abort_unless(auth()->user()->id == $torrent->user_id, 403);

        return view('site.torrents.edit', compact('torrent', 'categories', 'medias', 'fansubs'));
    }

    public function update(UpdateRequest $request, $torrent_id)
    {
        $user = $request->user();

        if ($request->get('silver') && $request->get('freeleech')) {
            toastr()->error('Silver e Freeleech dão conflito, escolha apenas 1.', 'Erro');
            return redirect()->back()->withInput();
        }

        $torrent = Torrent::findOrFail($torrent_id);

        abort_unless($user->id == $torrent->user_id, 403);

        $torrent->update($request->except('token'));

        return redirect()->to('torrents');
    }

    public function destroy($torrent_id)
    {
        //
    }

    public function download($torrent_id, Request $request)
    {
        $user = $request->user();
        $torrent = Torrent::where('id', '=', $torrent_id)->firstOrFail();

        if ($user->ratio() < setting('low_ratio')) {
            toastr()->warning('Seu ratio esta muito baixo para download!', 'Aviso');
            return redirect()->route('torrent.show', ['id' => $torrent->id, 'slug' => $torrent->slug]);
        }

        if ($user->permission->torrents_download == false) {
            toastr()->warning('Sua permissão de fazer download em torrents foram revogadas!!', 'Aviso');
            return redirect()->route('torrent.show', ['id' => $torrent->id, 'slug' => $torrent->slug]);
        }

        $file = Storage::disk('torrents')->exists("{$torrent->id}.torrent");

        if (!$file) {
            toastr()->error('Arquivo nao encontrado. Report esse torrent!', 'Aviso');
            return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
        }

        abort_unless(auth()->user()->permission->torrents_download, 403);

        $torrent->increment('downs');

        //give points to user
        $points = setting('points_download');
        $user->updatePoints($points);

        return $this->torrentTool->send($torrent_id, $torrent->name);
    }

    public function thanks($torrent_id, Request $request)
    {
        $user = $request->user();
        $torrent = Torrent::findOrFail($torrent_id);

        $thanks = $torrent->thanks()->where('user_id', '=', $user->id)->first();

        if ($thanks) {
            toastr()->info('Você já agradeceu esse torrent.', 'Info');
            return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
        }

        $thank = new Thank();
        $thank->torrent_id = $torrent->id;
        $thank->user_id = $user->id;
        $thank->save();

        //give points to user
        $points = setting('points_thanks');
        $user->updatePoints($points);

        return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
    }

    public function reSeed(Request $request, $torrent_id)
    {
        $user = $request->user();
        $torrent = Torrent::findOrFail($torrent_id);

        $completed = Complete::where('torrent_id', '=', $torrent->id)->get();

        if ($torrent->seeders <= 2) {
            // Send Notification
            foreach ($completed as $complete) {
                User::find($complete->user_id)->notify(new NewReseedRequestNotification($torrent));
            }

            User::find($torrent->user_id)->notify(new NewReseedRequestNotification($torrent));

            // Activity Log
            $this->log::record("Membro {$user->name} solicitou uma solicitação de nova propagação no torrent, ID: {$torrent->id} NOME: {$torrent->name}.");

            toastr()->success('Uma notificação foi enviada a todos os usuários que baixaram esse torrent junto com o uploader original!', 'Aviso');
            return redirect()->route('torrent', ['id' => $torrent->id, 'slug' => $torrent->slug]);
        } else {
            toastr()->error('Este torrent não atende às regras para uma solicitação de nova propagação.', 'Aviso');
            return redirect()->route('torrent', ['id' => $torrent->id, 'slug' => $torrent->slug]);
        }
    }

    public function uploads(Request $request)
    {
        //Show all torrents uploaded by the user
        $user = $request->user();

        $uploads = Torrent::with('category:id,name')
            ->select('id', 'user_id', 'category_id', 'name', 'slug', 'size', 'seeders', 'leechers', 'times_completed', 'created_at')
            ->where('user_id', '=', $user->id)
            ->get();

        return view('site.users.uploads', compact('uploads'));
    }
}
