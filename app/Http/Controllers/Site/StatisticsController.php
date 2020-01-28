<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Cheater;
use App\Models\Comment;
use App\Models\Complete;
use App\Models\Group;
use App\Models\Historic;
use App\Models\Invitation;
use App\Models\Peer;
use App\Models\Report;
use App\Models\Thank;
use App\Models\Torrent;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    protected $expire_at;

    public function __construct()
    {
        $this->middleware('auth');
        $this->expire_at = Carbon::now()->addMinutes(1);
    }

    public function index()
    {
        // Total Members Count
        $total_users = cache()->remember('total_users', $this->expire_at, function () {
            return User::count();
        });

        // Total pending Members Count
        $pending_user = cache()->remember('pending_users', $this->expire_at, function () {
            return User::where('status', '=', 0)->count();
        });

        // Total activated Members Count
        $activated_user = cache()->remember('activated_users', $this->expire_at, function () {
            return User::where('status', '=', 1)->count();
        });

        // Total suspended Members Count
        $suspended_user = cache()->remember('suspended_users', $this->expire_at, function () {
            return User::where('status', '=', 2)->count();
        });

        // Total banned Members Count
        $banned_user = cache()->remember('banned_users', $this->expire_at, function () {
            return User::where('status', '=', 3)->count();
        });

        // Total Torrents Count
        $total_torrents = cache()->remember('total_torrents', $this->expire_at, function () {
            return Torrent::count();
        });

        // Total Torrent Size
        $torrent_size = cache()->remember('torrent_size', $this->expire_at, function () {
            return Torrent::sum('size');
        });

        // Total Seeders
        $num_seeders = cache()->remember('num_seeders', $this->expire_at, function () {
            return Peer::where('is_seeder', '=', 1)->count();
        });

        // Total Leechers
        $num_leechers = cache()->remember('num_leechers', $this->expire_at, function () {
            return Peer::where('is_leecher', '=', 1)->count();
        });

        // Total Peers
        $num_peers = cache()->remember('num_peers', $this->expire_at, function () {
            return Peer::count();
        });

        //Total Upload Traffic Without Double Upload
        $real_upload = cache()->remember('actual_upload', $this->expire_at, function () {
            return Historic::sum('real_uploaded');
        });

        //Total Upload Traffic With Double Upload
        $credited_upload = cache()->remember('credited_upload', $this->expire_at, function () {
            return Historic::sum('uploaded');
        });

        //Total Download Traffic Without Freeleech
        $real_download = cache()->remember('actual_download', $this->expire_at, function () {
            return Historic::sum('real_downloaded');
        });

        //Total Download Traffic With Freeleech
        $credited_download = cache()->remember('credited_download', $this->expire_at, function () {
            return Historic::sum('downloaded');
        });

        //Total Up/Down Traffic without perks
        $actual_up_down = $real_upload + $real_download;

        //Total Up/Down Traffic with perks
        $credited_up_down = $credited_upload + $credited_download;

        $total_comments = cache()->remember('total_comments', $this->expire_at, function () {
            return Comment::count();
        });

        $total_cheaters = cache()->remember('total_cheaters', $this->expire_at, function () {
            return Cheater::count();
        });

        $invitations = cache()->remember('invitations', $this->expire_at, function () {
            return Invitation::where('is_accepted', '=', true)->count();
        });

        $total_reports = cache()->remember('total_reports', $this->expire_at, function () {
            return Report::count();
        });

        $reports_solved = cache()->remember('reports_solved', $this->expire_at, function () {
            return Report::where('is_solved', '=', true)->count();
        });

        $torrent_completes = cache()->remember('torrent_completes', $this->expire_at, function () {
            return Complete::count();
        });

        $total_thanks = cache()->remember('total_thanks', $this->expire_at, function () {
            return Thank::count();
        });

        return view('site.stats.index', [
            'total_users' => $total_users,
            'pending_user' => $pending_user,
            'activated_user' => $activated_user,
            'suspended_user' => $suspended_user,
            'banned_user' => $banned_user,
            'total_torrents' => $total_torrents,
            'torrent_size' => $torrent_size,
            'num_seeders' => $num_seeders,
            'num_leechers' => $num_leechers,
            'num_peers' => $num_peers,
            'real_upload' => $real_upload,
            'real_download' => $real_download,
            'actual_up_down' => $actual_up_down,
            'credited_upload' => $credited_upload,
            'credited_download' => $credited_download,
            'credited_up_down' => $credited_up_down,
            'total_comments' => $total_comments,
            'total_cheaters' => $total_cheaters,
            'invitations' => $invitations,
            'total_reports' => $total_reports,
            'reports_solved' => $reports_solved,
            'torrent_completes' => $torrent_completes,
            'total_thanks' => $total_thanks
        ]);
    }

    public function uploaded()
    {
        // Fetch Top Uploaders
        $uploaders = cache()->remember('uploaders', $this->expire_at, function () {
            return User::latest('uploaded')
                ->select('id', 'username', 'slug', 'uploaded', 'downloaded', 'show_profile')
                ->whereNotIn('status', [0, 2, 3])->take(100)->get();
        });

        return view('site.stats.users.uploaded', compact('uploaders'));
    }

    public function downloaded()
    {
        // Fetch Top Downloaders
        $downloaders = cache()->remember('downloaders', $this->expire_at, function () {
            return User::latest('downloaded')
                ->select('id', 'username', 'slug', 'uploaded', 'downloaded', 'show_profile')
                ->whereNotIn('status', [0, 2, 3])->take(100)->get();
        });

        return view('site.stats.users.downloaded', compact('downloaders'));
    }

    public function seeders()
    {
        // Fetch Top Seeders
        $seeders = Peer::with('user')
            ->select(DB::raw('user_id, count(*) as value'))
            ->where('is_seeder', '=', 1)
            ->groupBy('user_id')
            ->latest('value')
            ->take(100)
            ->get();

        return view('site.stats.users.seeders', compact('seeders'));
    }

    public function leechers()
    {
        // Fetch Top Leechers
        $leechers = Peer::with('user')
            ->select(DB::raw('user_id, count(*) as value'))
            ->where('is_leecher', '=', 1)
            ->groupBy('user_id')
            ->latest('value')
            ->take(100)
            ->get();

        return view('site.stats.users.leechers', compact('leechers'));
    }

    public function uploaders()
    {
        // Fetch Top Uploaders
        $uploaders = Torrent::with('user')
            ->select(DB::raw('user_id, count(*) as value'))
            ->groupBy('user_id')
            ->latest('value')
            ->take(100)
            ->get();

        return view('site.stats.users.uploaders', compact('uploaders'));
    }

    public function points()
    {
        // Fetch Top Points
        $points = User::latest('points')->whereNotIn('status', [0, 2, 3])->take(100)->get();

        return view('site.stats.users.points', compact('points'));
    }

    public function levels()
    {
        // Fetch Top Levels
        $levels = User::latest('experience')->whereNotIn('status', [0, 2, 3])->take(100)->get();

        return view('site.stats.users.levels', compact('levels'));
    }

    public function seedtime()
    {
        //TODO: fix foreach
        // Fetch Top Total Seedtime
        $seedtimes = Historic::with('user')
            ->groupBy('user_id')
            ->take(100)
            ->sum('seed_time');

        return view('site.stats.users.seedtime', compact('seedtimes'));
    }

    public function seedsize()
    {
        //TODO: fix foreach
        // Fetch Top Total Seedsize Users
        $seedsizes = User::with(['peers', 'torrents'])
            ->select(DB::raw('user_id, count(*) as value'))
            ->groupBy('user_id')
            ->latest('value')
            ->take(100)
            ->sum('uploaded');

        return view('site.stats.users.seedsize', compact('seedsizes'));
    }

    public function seeded()
    {
        // Fetch Top Seeded
        $seeded = Torrent::latest('seeders')->take(100)->get();

        return view('site.stats.torrents.seeded', compact('seeded'));
    }

    public function leeched()
    {
        // Fetch Top Leeched
        $leeched = Torrent::latest('leechers')->take(100)->get();

        return view('site.stats.torrents.leeched', compact('leeched'));
    }

    public function completed()
    {
        // Fetch Top Completed
        $completed = Torrent::latest('times_completed')->take(100)->get();

        return view('site.stats.torrents.completed', compact('completed'));
    }

    public function dying()
    {
        // Fetch Top Dying
        $dying = Torrent::where('seeders', '=', 1)->where('times_completed', '>=', '1')->latest('leechers')->take(100)->get();

        return view('site.stats.torrents.dying', compact('dying'));
    }

    public function dead()
    {
        // Fetch Top Dead
        $dead = Torrent::where('seeders', '=', 0)->latest('leechers')->take(100)->get();

        return view('site.stats.torrents.dead', compact('dead'));
    }

    public function groups()
    {
        // Fetch Groups User Counts
        $groups = Group::oldest('id')->get();

        return view('site.stats.groups.groups', compact('groups'));
    }

    public function group($slug)
    {
        // Fetch Users In Group
        $group = Group::select('id', 'name')->whereSlug($slug)->firstOrFail();
        $users = User::select('id', 'username', 'slug', 'group_id', 'avatar', 'created_at')
            ->where('group_id', '=', $group->id)->latest()->paginate(100);

        return view('site.stats.groups.group', compact('users', 'group'));
    }

}
