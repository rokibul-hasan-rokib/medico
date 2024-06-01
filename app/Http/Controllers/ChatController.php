<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Get all users for sending messages
        $users = User::where('id', '!=', $user->id)->get();

        // Get messages where the authenticated user is either sender or receiver
        $messages = Message::where('sender_id', $user->id)
                           ->orWhere('receiver_id', $user->id)
                           ->with(['sender', 'receiver'])
                           ->get();

        return view('chat.index', compact('messages', 'users'));
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'read' => false,
        ]);

        return redirect()->back()->with('success', 'Message sent successfully!');
    }
}