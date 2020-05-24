<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Events\ChatSent;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('chat.chat');
    }

    /**
     * Fetch all chat messages from the database.
     *
     * @return array \App\Chat
     */
    public function fetchAllMessages()
    {
        return Chat::with('user')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function sendMessage(Request $request)
    {
        $chat = auth()->user()->messages()->create([
            'message' => $request->message
        ]);
        broadcast(new ChatSent($chat->load('user')))->toOthers();

        return ['status' => 'success'];
    }
}
