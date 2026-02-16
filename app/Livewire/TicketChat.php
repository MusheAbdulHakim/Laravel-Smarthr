<?php

namespace App\Livewire;

use App\Events\TicketReplied;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Event;
use Livewire\Attributes\Js;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class TicketChat extends Component
{
    use WithFileUploads;

    public $ticket;

    public $replies;

    public $message;

    public function replyTicket()
    {
        $this->validate([
            'message' => 'required',
        ]);
        $repliedTk = TicketReply::create([
            'ticket_id' => $this->ticket->id,
            'reply_id' => null,
            'message' => $this->message,
            'created_by' => auth()->user()->id,
            'is_read' => true,
        ]);
        $this->dispatch('refreshReplies');
        Event::dispatch(new TicketReplied($repliedTk, $this->ticket));
        $this->message = '';
    }

    #[On('echo:tickets,TicketReplied')]
    public function ticketReplied()
    {
        $this->fetchReplies();
    }

    #[On('refreshReplies')]
    public function fetchReplies()
    {
        $this->replies = $this->ticket->replies()->get();
        $this->scrollPage();
    }

    #[Js]
    public function scrollPage()
    {
        return '
            setTimeout(() => {
                document.getElementById("chatContent").scrollTop = document.getElementById("chatContent").scrollHeight
            }, 1000);
        ';
    }

    public function render()
    {
        return view('livewire.ticket-chat');
    }
}
