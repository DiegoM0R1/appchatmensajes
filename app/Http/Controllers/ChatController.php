<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.index', compact('users'));
    }

    public function show(User $user)
{
    $authUser = Auth::user();
    $messages = Message::where(function ($query) use ($authUser, $user) {
        $query->where('user_id', $authUser->id)->where('receiver_id', $user->id);
    })->orWhere(function ($query) use ($authUser, $user) {
        $query->where('user_id', $user->id)->where('receiver_id', $authUser->id);
    })->get();

    $users = User::where('id', '!=', $authUser->id)->get();

    return view('chat.show', compact('user', 'messages', 'users'));
}


    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required_without:file',
            'file' => 'nullable|file',
        ]);

        $message = new Message();
        $message->user_id = Auth::id();
        $message->receiver_id = $request->receiver_id;
        $message->message = $request->message;

        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('uploads', 'public');
            $message->file_path = $filePath;
        }

        $message->save();

        return redirect()->route('chat.show', $request->receiver_id);
    }
}

