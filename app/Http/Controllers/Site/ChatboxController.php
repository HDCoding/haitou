<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Http\Requests\Site\ChatboxRequest;
use App\Models\Chatbox;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

class ChatboxController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $messages = Cache::remember('chatbox_messages', 60, function () {
            return Chatbox::with('user:id,group_id,avatar')
                ->orderBy('id', 'DESC')
                ->take(50)
                ->get();
        });

        $messages = $messages->reverse();

        return view('site.chatbox.index', compact('messages'));
    }

    public function fetch()
    {
        $user = auth()->user();

        if (request()->ajax()) {
            $messages = Cache::remember('chatbox_messages', 60, function () {
                return Chatbox::with('user:id,group_id,avatar')
                    ->orderBy('id', 'DESC')
                    ->take(50)
                    ->get();
            });

            $messages = $messages->reverse();
            $data = [];
            foreach ($messages as $message) {
                $class = '';
                if (in_array($user->id, explode(',', $message->mentions))) {
                    $class = 'mentioned';
                }
                $data[] = '<li class="chat-item ' . $class . '">'
                    . '<div class="chat-img">'
                    . '<img src="' . $message->user->avatar() . '" alt="' . $message->username . '">'
                    . '</div>'
                    . '<div class="chat-content">'
                    . '<h6 class="font-medium">'
                    . link_to_route('user.profile', $message->username, [strtolower($message->username)], ['target' => '_blank'])
                    . ' - '
                    . '<span style="color:' . $message->user->group->color . '">' . $message->user->groupName() . '</span>'
                    . '</h6>'
                    . '<div class="box bg-light-info">'
                    . $message->message
                    . '</div>'
                    . '</div>'
                    . '<div class="chat-time">' . $message->created_at->diffForHumans() . '</div>'
                    . '</li>';
            }

            return response()->json(['success' => true, 'data' => $data]);
        }
    }

    public function send(ChatboxRequest $request)
    {
        $user = $request->user();

        $message = $request->input('message');

        $checkSendRate = Chatbox::where('user_id', '=', $user->id)
            ->where('created_at', '>=', Carbon::now()->subSeconds(2))
            ->first();

        if ($checkSendRate) {
            return toastr()->info('Aguarde 2 segundos entre as postagens, por favor', 'Chat');
        }

        if ($request->ajax()) {
            preg_match_all('/(@\w+)/', $message, $mentions);

            $mentionIDs = [];

            foreach ($mentions[0] as $mention) {
                $findUser = User::where('username', 'LIKE', '%' . str_replace('@', '', $mention) . '%')->first();
                if (!empty($findUser->id)) {
                    $mentionIDs[] = $findUser->id;
                }
            }

            $mentions = implode(',', $mentionIDs);

            if ($mentions) {
                Chatbox::create(['user_id' => $user->id, 'username' => $user->username, 'message' => $message, 'mentions' => $mentions]);
            } else {
                Chatbox::create(['user_id' => $user->id, 'username' => $user->username, 'message' => $message]);
            }

            $data = '<li class="chat-item">';
            $data .= '<div class="chat-img">';
            $data .= '<img src="' . $user->avatar() . '" alt="' . $user->username . '">';
            $data .= '</div>';
            $data .= '<div class="chat-content">';
            $data .= '<h6 class="font-medium">';
            $data .= link_to_route('user.profile', $user->username, [$user->slug], ['target' => '_blank']);
            $data .= ' - ';
            $data .= '<span style="color:' . $user->group->color . '">' . $user->groupName() . '</span>';
            $data .= '</h6>';
            $data .= '<div class="box bg-light-info">';
            $data .= $message;
            $data .= '</div>';
            $data .= '</div>';
            $data .= '<div class="chat-time">' . Carbon::now()->diffForHumans() . '</div>';
            $data .= '</li>';

            Cache::forget('chatbox_messages');
            return response()->json(['success' => true, 'data' => $data]);
        }
    }
}
