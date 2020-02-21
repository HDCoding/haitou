<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ReportRequest;
use App\Models\Calendar;
use App\Models\Comment;
use App\Models\Log;
use App\Models\Post;
use App\Models\Report;
use App\Models\Torrent;
use App\User;

class ReportsController extends Controller
{
    private $log;

    public function __construct()
    {
        $this->middleware('auth');
        $this->log = new Log();
    }

    public function calendar($calendar_id)
    {
        $calendar = Calendar::findOrFail($calendar_id);
        return view('site.reports.calendar', compact('calendar'));
    }

    public function comment($comment_id)
    {
        $comment = Comment::findOrFail($comment_id);
        return view('site.reports.comment', compact('comment'));
    }

    public function post($post_id)
    {
        $post = Post::findOrFail($post_id);
        return view('site.reports.post', compact('post'));
    }

    public function torrent($torrent_id)
    {
        $torrent = Torrent::where('id', '=', $torrent_id)->select(['id', 'name'])->firstOrFail();
        return view('site.reports.torrent', compact('torrent'));
    }

    public function user($user_id)
    {
        $user = User::where('id', '=', $user_id)->select(['id', 'username'])->firstOrFail();
        return view('site.reports.user', compact('user'));
    }

    public function store(ReportRequest $request)
    {
        $user = $request->user();

        $report = new Report();
        $report->user_id = $user->id;
        $report->calendar_id = $request->input('calendar_id');
        $report->comment_id = $request->input('comment_id');
        $report->member_id = $request->input('member_id');
        $report->post_id = $request->input('post_id');
        $report->torrent_id = $request->input('torrent_id');
        $report->report_type = $request->input('report_type');
        $report->name = $request->input('name');
        $report->reason = $request->input('reason');
        $report->save();

        //give points to user
        $points = setting('points_report');
        $user->updatePoints($points);

        //increment number of reports
        $user->num_report += 1;
        $user->update();

        $this->log::record('Registrou um novo report.');

        toastr()->success('Report recebido com sucesso. Iremos analizar o mais breve possível.', 'Report');
        return redirect()->to('home');
    }
}
