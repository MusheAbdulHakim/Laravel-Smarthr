<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseController;

class ChatController extends BaseController
{
    public function __construct(){
        parent::__construct();
        \RTippin\Messenger\Facades\Messenger::setProvider(auth()->user());
    }


    public function index()
    {
        return view('apps.messenger.portal')->with('mode', 5);
    }

    /**
     * @param  string  $thread
     */
    public function showThread(string $thread)
    {
        return view('apps.messenger.portal')->with([
            'mode' => 0,
            'thread_id' => $thread,
        ]);
    }

    /**
     * @param  string  $alias
     * @param  string  $id
     */
    public function showCreatePrivate(string $alias, string $id)
    {
        return view('apps.messenger.portal')->with([
            'mode' => 3,
            'alias' => $alias,
            'id' => $id,
        ]);
    }

    /**
     * @param  string  $thread
     * @param  string  $call
     */
    public function showVideoCall(string $thread, string $call)
    {
        return view('apps.messenger.video')->with([
            'threadId' => $thread,
            'callId' => $call,
        ]);
    }

    /**
     * @param  string  $invite
     */
    public function showJoinWithInvite(string $invite)
    {
        return view('apps.messenger.invitation')->with([
            'code' => $invite,
            'special_flow' => true,
        ]);
    }
    

    public function messenger(){
        $pageTitle = __("Chat");
        $user = auth()->user();
        return view('apps.messenger.portal',compact(
            'pageTitle','user'
        ))->with('mode', 5);
    }
}
