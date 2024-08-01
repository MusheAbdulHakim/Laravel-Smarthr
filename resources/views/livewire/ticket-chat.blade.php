
<div class="chat-window" x-data="{}">
    <div class="fixed-header">
        <div class="navbar">
            <div class="task-assign">
                @if (!empty($ticket->user_id))
                <span class="assign-title">{{ __('Assigned to') }} </span> 
                <a href="#" data-bs-toggle="tooltip" data-placement="bottom" title="{{ $ticket->user->full_name ?? '' }}" class="avatar">
                    <img src="{{ !empty($ticket->user->avatar) ? uploadedAsset($ticket->user->avatar,'users'): asset('images/user.jpg') }}" alt="User Image">
                </a>
                @endif
                @can('edit-ticket')
                <a href="#" class="followers-add" title="{{ __('Assign To User') }}" data-bs-toggle="modal" data-bs-target="#assignee"><i class="material-icons">add</i></a>
                @endcan
            </div>
            @if (auth()->user()->canAny(['edit-ticket','delete-ticket']))
            <ul class="nav float-end custom-menu">
                <li class="nav-item dropdown dropdown-action">
                    <a href="" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                    <div class="dropdown-menu custom-dropdown-menu">
                        @can('edit-ticket')
                        <a class="dropdown-item" href="javascript:void(0)" data-url="{{ route('tickets.edit', $ticket->id) }}" data-ajax-modal="true"
                            data-title="{{ __('Edit Ticket') }}" data-size="lg">
                            {{ __('Edit Ticket') }}
                        </a>
                        @endcan
                        @can('delete-ticket')
                        <a class="dropdown-item deleteBtn" data-route="{{ route('tickets.destroy', $ticket->id) }}" data-title="{{ __('Delete Ticket') }}"
                            data-question="{{ __('Are you sure you want to delete?') }}" href="javascript:void(0)">
                            {{ __('Delete Ticket') }}
                        </a>
                        @endcan
                    </div>
                </li>
            </ul>
            @endif
        </div>
    </div>
    <div class="chat-contents task-chat-contents">
        <div class="chat-content-wrap">
            <div class="chat-wrap-inner" id="chatContent">
                <div class="chat-box">
                    <div class="chats">
                        @if (!empty($replies) && $replies->count() > 0)
                           @foreach ($replies as $reply)
                            @if (($reply->created_by == auth()->user()->id ))
                            <div class="chat chat-right" x-transition>
                                <div class="chat-body">
                                    <div class="chat-bubble">
                                        <div class="chat-content">
                                            {!! $reply->message !!}
                                            <span class="chat-time">{{ $reply->created_at->format('H:i A') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            @else
                            <div class="chat chat-left" x-transition>
                                <div class="chat-avatar">
                                    <a @can('view-Employeeprofile') href="{{ route('employees.show', ['employee' => \Crypt::encrypt($reply->created_by)]) }}" @else href="#" @endcan class="avatar">
                                        <img src="{{ !empty($reply->createdBy->avatar) ? uploadedAsset($reply->createdBy->avatar,'users'): asset('images/user.jpg') }}" alt="User Image">
                                    </a>
                                </div>
                                <div class="chat-body">
                                    <div class="chat-bubble">
                                        <div class="chat-content">
                                            <span class="task-chat-user">{{ $reply->createdBy->fullname }}</span> <span class="chat-time">{{ $reply->created_at->format('H:i A') }}</span>
                                            {!! $reply->message !!}
                                        </div>
                                    </div>
                                </div>
                            </div>  
                            @endif
                           @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="chat-footer">
        <div class="message-bar">
            <div class="message-inner">
                <div class="">
                    <div class="input-group flex-nowrap">
                        <textarea class="form-control" wire:keydown.enter="replyTicket" required wire:model="message" placeholder="Type message..."></textarea>
                        <button class="btn btn-primary input-group-text" wire:click="replyTicket" type="button"><i class="fa-solid fa-paper-plane"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>  
    
    @script
    <script defer type="module">
        document.addEventListener('livewire:initialized', () => {
            Livewire.dispatch('refreshReplies')
            document.getElementById("chatContent").scrollTop = document.getElementById("chatContent").scrollHeight
        })
        Livewire.on('refreshReplies', () => {
            document.getElementById("chatContent").scrollTop = document.getElementById("chatContent").scrollHeight
            $wire.scrollPage()
            setTimeout(scrollChatDiv, 2000);
        })
        document.addEventListener("DOMContentLoaded", (event) => {
            setTimeout(scrollChatDiv, 2000);
        });

        function scrollChatDiv()
        {
            document.getElementById("chatContent").scrollTop = document.getElementById("chatContent").scrollHeight
        }
    </script>
    @endscript
</div>
