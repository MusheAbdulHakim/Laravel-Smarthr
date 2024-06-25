<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        return redirect('apps/chatify');
        // $pageTitle = 'Chat';
        // $user = auth()->user();
        // return view('apps.chat', compact(
        //     'pageTitle',
        //     'user'
        // ));
    }
}
