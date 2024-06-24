<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {
        $pageTitle = 'Chat';
        $user = auth()->user();
        return view('apps.chat', compact(
            'pageTitle',
            'user'
        ));
    }
}
