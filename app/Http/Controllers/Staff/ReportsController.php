<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Http\Requests\Staff\ReportsRequest;
use App\Models\Report;
use Carbon\Carbon;
use function foo\func;

class ReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('allow:relatorios-mod');
    }

    public function index()
    {
        // For Cache
        $expire_at = Carbon::now()->addMinutes(5);

        $reports = Report::select('id', 'name', 'report_type', 'is_solved')->orderBy('id', 'DESC')->get();

        //Count total
        $total = cache()->remember('reports_total', $expire_at, function () {
            return Report::count();
        });
        //Count Resolved
        $resolve = cache()->remember('reports_resolved', $expire_at, function () {
            return Report::where('is_solved', '=', true)->count();
        });
        //Count Pending
        $pending = cache()->remember('reports_pending', $expire_at, function () {
            return Report::where('is_solved', '=', false)->count();
        });

        //Total Report Calendars
        $calendars = cache()->remember('total_report_calendar', $expire_at, function() {
            return Report::whereNotNull('calendar_id')->count();
        });

        //Total Report Comments
        $comments = cache()->remember('total_report_comment', $expire_at, function() {
            return Report::whereNotNull('comment_id')->count();
        });

        //Total Report Members
        $members = cache()->remember('total_report_member', $expire_at, function() {
            return Report::whereNotNull('member_id')->count();
        });

        //Total Report Posts
        $posts = cache()->remember('total_report_post', $expire_at, function() {
            return Report::whereNotNull('post_id')->count();
        });

        //Total Report Calendars
        $torrents = cache()->remember('total_report_torrent', $expire_at, function() {
            return Report::whereNotNull('torrent_id')->count();
        });

        return view('staff.reports.index', [
            'reports' => $reports,
            'total' => $total,
            'resolve' => $resolve,
            'pending' => $pending,
            'calendars' => $calendars,
            'comments' => $comments,
            'members' => $members,
            'posts' => $posts,
            'torrents' => $torrents
        ]);
    }

    public function calendar($report_id)
    {
        $report = Report::with('calendar:id,name,slug')
            ->with('user:id,username,slug')
            ->with('staff:id,username,slug,avatar')
            ->where('id', '=', $report_id)
            ->firstOrFail();

        return view('staff.reports.calendar', compact('report'));
    }

    public function comment($report_id)
    {
        $report = Report::with('comment:id')
            ->with('user:id,username,slug')
            ->with('staff:id,username,slug,avatar')
            ->where('id', '=', $report_id)
            ->firstOrFail();

        return view('staff.reports.comment', compact('report'));
    }

    public function member($report_id)
    {
        $report = Report::with('member:id,username,slug')
            ->with('user:id,username,slug')
            ->with('staff:id,username,slug,avatar')
            ->where('id', '=', $report_id)
            ->firstOrFail();

        return view('staff.reports.member', compact('report'));
    }

    public function post($report_id)
    {
        //TODO
        //look to a better way to show the post, where was made and permission to read
        $report = Report::with('post')
            ->with('user:id,username,slug')
            ->with('staff:id,username,slug,avatar')
            ->where('id', '=', $report_id)
            ->firstOrFail();

        return view('staff.reports.post', compact('report'));
    }

    public function torrent($report_id)
    {
        $report = Report::with('torrent')
            ->with('user:id,username,slug')
            ->with('staff:id,username,slug,avatar')
            ->where('id', '=', $report_id)
            ->firstOrFail();

        return view('staff.reports.torrent', compact('report'));
    }

    public function update(ReportsRequest $request, $report_id)
    {
        $report = Report::findOrFail($report_id);
        $report->staff_id = auth()->user()->id;
        $report->solution = $request->input('solution');
        $report->is_solved = true;
        $report->update();

        toastr()->success('Report atualizado.', 'Sucesso');
        return redirect()->to('staff/reports');
    }
}
