<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Calendar;
use App\Models\Thank;
use App\Models\Torrent;
use App\Notifications\NewCalendarThankYouNotification;
use App\Notifications\NewTorrentThankYouNotification;
use App\User;
use Illuminate\Http\Request;

class ThanksController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function calendar(Request $request, $calendar_id)
    {
        $user = $request->user();
        $calendar = Calendar::findOrFail($calendar_id);

        $thanks = $calendar->thanks()->where('user_id', '=', $user->id)->first();

        if ($thanks) {
            toastr()->info('Você já agradeceu esse evento.', 'Info');
            return redirect()->route('calendars.show', [$calendar->id, $calendar->slug]);
        }

        if ($user->id == $calendar->user_id) {
            toastr()->warning('Você não pode agradecer seu próprio Evento.', 'Aviso');
            return redirect()->route('calendars.show', [$calendar->id, $calendar->slug]);
        }

        $thank = new Thank();
        $thank->calendar_id = $calendar->id;
        $thank->user_id = $user->id;
        $thank->save();

        //Thank you notification to who post
        $poster = User::where('id', '=', $calendar->user_id)->first();
        $poster->notify(new NewCalendarThankYouNotification($calendar));

        // Give points to both users
        $points = setting('points_thanks');
        //logged user
        $user->updatePoints($points);
        //uploader
        $poster->updateOfflinePoints($calendar->user_id, $points);

        //increment number of comment
        $user->num_thank += 1;
        $user->update();

        return redirect()->route('calendars.show', [$calendar->id]);
    }

    public function torrent(Request $request, $torrent_id)
    {
        $user = $request->user();
        $torrent = Torrent::findOrFail($torrent_id);

        $thanks = $torrent->thanks()->where('user_id', '=', $user->id)->first();

        if ($thanks) {
            toastr()->info('Você já agradeceu esse torrent.', 'Info');
            return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
        }

        if ($user->id == $torrent->user_id) {
            toastr()->warning('Você não pode agradecer seu próprio Upload.', 'Aviso');
            return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
        }

        $thank = new Thank();
        $thank->torrent_id = $torrent->id;
        $thank->user_id = $user->id;
        $thank->save();

        //Thank you notification to uploader
        $uploader = User::where('id', '=', $torrent->user_id)->first();
        $uploader->notify(new NewTorrentThankYouNotification($torrent));

        // Give points to both users
        $points = setting('points_thanks');
        //logged user
        $user->updatePoints($points);
        //uploader
        $uploader->updateOfflinePoints($torrent->user_id, $points);

        //increment number of comment
        $user->num_thank += 1;
        $user->update();

        return redirect()->route('torrent.show', [$torrent->id, $torrent->slug]);
    }

}
