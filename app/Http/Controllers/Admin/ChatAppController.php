<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Models\ChatMessage;

class ChatAppController extends BaseController
{
    public function index()
    {
        $pageTitle = __('Chat');
        $user = auth()->user();
        $default = true;

        return view('apps.chat', compact(
            'user', 'pageTitle', 'default'
        ));
    }

    public function destroy($receiver)
    {
        $userId = auth()->user()->id;
        $messages = ChatMessage::where(function ($query) use ($userId, $receiver) {
            $query->where('from_id', $userId)->where('receiver_id', $receiver);
        })
            ->orWhere(function ($query) use ($userId, $receiver) {
                $query->where('from_id', $receiver)->where('receiver_id', $userId);
            })
            ->pluck('id')->all();
        ChatMessage::destroy($messages);
        $notification = notify(__('Conversation has been deleted'));

        return redirect()->route('app.chat')->with($notification);
    }
}
