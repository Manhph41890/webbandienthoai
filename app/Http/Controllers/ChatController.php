<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\Message; 
use Auth;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    // Lấy lịch sử tin nhắn
    public function getMessages($userId)
    {
        return Message::where(function ($q) use ($userId) {
            $q->where('sender_id', Auth::id())->where('receiver_id', $userId);
        })
            ->orWhere(function ($q) use ($userId) {
                $q->where('sender_id', $userId)->where('receiver_id', Auth::id());
            })
            ->orderBy('created_at', 'asc')
            ->get();
    }

    // Gửi tin nhắn
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
        ]);

        // broadcast(new MessageSent($message->load('sender')))->toOthers();

        return response()->json(['status' => 'Message Sent!', 'message' => $message]);
    }
}
