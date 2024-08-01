<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use RTippin\Janus\Facades\Janus;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class ChatAppController extends BaseController
{

    public function index(){
        $pageTitle = __("Chat");
        $user = auth()->user();
        $default = true;
        return view('apps.chat',compact(
            'user','pageTitle','default'
        ));
    }
}
