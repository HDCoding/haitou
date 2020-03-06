<?php

namespace App\Http\Controllers\Api;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Resources\ChatRoomResource;
use App\Models\Chatroom;
use App\Models\Message;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function rooms()
    {
        $chat_rooms = Chatroom::all();
        return ChatRoomResource::collection($chat_rooms);
    }

    public function changeChatroom(Request $request)
    {
        $user = $request->user();
        $chat = $request->input('chatroom');
        $chat_room = Chatroom::findOrFail($chat['i']);

        // update users current chatroom
        $user->chatrooms()
            ->associate($chat_room)
            ->save();
    }

    public function messages()
    {
        $chatroom = Chatroom::findOrFail(1);

        $messages = Message::with('user:username')
            ->where('chatroom_id', '=', $chatroom->id)
            ->get();

        return $messages;
    }

    public function sendMessage(Request $request)
    {
        $user = $request->user();

        $chatroom = Chatroom::findOrFail(1);

        $message = new Message([
            'chatroom_id' => $chatroom->id,
            'user_id' => $user->id,
            'content' => $request->input('message')
        ]);

        $message->chatroom()->associate($chatroom);

        $message->user()->associate($user)->save();

        broadcast(new MessageSent($user, $chatroom, $message))->toOthers();

        return [
            'status' => 'Message Sent!'
        ];
    }
}
