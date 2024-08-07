<?php

namespace App\Livewire\Apps\Chat;

use App\Models\User;
use Livewire\Component;
use App\Models\ChatMessage;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Events\ChatMessageSent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Event;

class Box extends Component
{
    use WithFileUploads;

    public $userId;
    public $messageBody, $attachment;
    

    public function mount($userId = null)
    {
        if(!empty($userId)){
            $this->userId = $userId;
        }
    }

    public function getUser(){
        return User::findOrFail(Crypt::decrypt($this->userId));
    }

    
    public function sendMessage()
    {
        $receiver = $this->getUser();
        $message = ChatMessage::create([
            'user_id' => auth()->user()->id,
            'from_id' => auth()->user()->id,
            'receiver_id' => $receiver->id,
            'body' => $this->messageBody,
            'type' => 'text',
            'is_read' => false,
        ]);
        $this->messageBody = '';
        ChatMessageSent::dispatch($message);
        $this->dispatch('scroll-chat');
    }

    #[On('echo:chat-message,ChatMessageSent')]
    public function refreshMessages($event)
    {
        $this->dispatch('scroll-chat');
    }

    public function fetchMessages()
    {
        $user_id = $this->getUser()->id;
        // mark unread as read
        ChatMessage::where('user_id', $user_id)
                ->where('receiver_id', auth()->user()->id)
                ->update([
                    'is_read' => true
                ]);
        return ChatMessage::where('from_id', Auth::user()->id)
            ->where('receiver_id', $user_id)
            ->orWhere('from_id', $user_id)
            ->where('receiver_id', Auth::user()->id);
            
    }


    #[Js] 
    public function scrollDown()
    {
        return 'setTimeout(() => {
            document.getElementById("chatContent").scrollTop = document.getElementById("chatContent").scrollHeight
        }, 500);';
    }

    public function render()
    {
        $user = null;
        $lastMessage = null;
        $messages =  null;

        if(!empty($this->userId)){
            $user = $this->getUser();
            $messages = $this->fetchMessages()
                        ->get();
            $lastMessage = $this->fetchMessages()->latest()->first();

        }
        return view('livewire.apps.chat.box',compact(
            'user','lastMessage','messages'
        ));
    }
}
