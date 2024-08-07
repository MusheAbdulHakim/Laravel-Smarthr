<div class="chat-main-wrapper">
    <!-- Chats View -->
    <div class="col-lg-9 message-view task-view">
        <div class="chat-window">
            @if (!empty($user))
            <div class="fixed-header">
                <div class="navbar">
                    <div class="user-details me-auto">
                        <div class="float-start user-img">
                            <a class="avatar" href="#" title="{{ $user->fullname }}">
                                <img src="{{ !empty($user->avatar) ? asset('storage/users/'.$user->avatar) : asset('images/user.jpg') }}" alt="User Image" class="rounded-circle">
                                @if (!empty($user->is_online)) 
                                <span class="status online"></span> 
                                @else
                                <span class="status offline"></span>
                                @endif
                            </a>
                        </div>
                        <div class="user-info float-start">
                            <a href="#" title="{{ $user->fullname }}"><span>{{ $user->fullname }}</span> </a>
                            @if (!$user->is_online && !empty($lastMessage))
                            <span class="last-seen">{{ __('Last seen') }} {{ $lastMessage->created_at->diffForHumans() ?? '' }}</span>
                            @endif
                        </div>
                    </div>
                    
                    <ul class="nav custom-menu">
                        <li class="nav-item">
                            <a class="nav-link task-chat profile-rightbar float-end" id="task_chat" href="#task_window"><i class="fa-solid fa-user"></i></a>
                        </li>
                        <li class="nav-item dropdown dropdown-action">
                            <a aria-expanded="false" data-bs-toggle="dropdown" class="nav-link dropdown-toggle" href=""><i class="fa-solid fa-gear"></i></a>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="javascript:void(0)" data-route="{{ route('chat.delete-conversation',[
                                    'receiver' => $user->id,
                                ]) }}" data-title="{{ __('Delete Conversation') }}"
                                data-question="{{ __('Are you sure you want to delete your chat?') }}" class="dropdown-item deleteBtn">{{ __('Delete Conversation') }}</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <blockquote></blockquote>
            <div class="chat-contents">
                <div class="chat-content-wrap">
                    <div class="chat-wrap-inner" x-data id="chatContent">
                        <div class="chat-box">
                            <div class="chats">
                                @if (!empty($messages) > 0)
                                @foreach ($messages as $message)
                                    @if (auth()->user()->id === $message->user_id)
                                    <div class="chat chat-right">
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    <p>{{ $message->body }}</p>
                                                    <span class="chat-time">{{ format_date($message->created_at, 'H:i a') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="chat chat-left">
                                        <div class="chat-avatar">
                                            <a href="#" class="avatar">
                                                <img src="{{ !empty($message->user->avatar) ? asset('storage/users/'.$message->user->avatar): asset('images/user.jpg') }}" alt="{{ __('Avatar') }}">
                                            </a>
                                        </div>
                                        <div class="chat-body">
                                            <div class="chat-bubble">
                                                <div class="chat-content">
                                                    {{ $message->body }}
                                                    <span class="chat-time">{{ format_date($message->created_at,'H:i a') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @if ($message->created_at->format('y-m-d') != now()->format('y-m-d'))
                                    <div class="chat-line">
                                        <span class="chat-date">{{ $message->created_at->format('d M, Y') }}</span>
                                    </div>
                                    @endif
                                @endforeach
                                @endif 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="chat-footer" x-data>
                <div class="message-bar">
                    <div class="message-inner">
                        <button type="button" class="btn btn-custom emoji-button">
                            <i class="fa-solid fa-smile"></i>
                        </button>
                        <div class="message-area">
                            <div class="input-group">
                                <textarea class="form-control" wire:model="messageBody" @keyup.enter="$wire.sendMessage" id="messageInput" placeholder="Type message..."></textarea>
                                <button class="btn btn-custom" type="button" wire:click="sendMessage"><i class="fa-solid fa-paper-plane"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="d-flex align-items-center justify-content-center my-5">
                <h4 class="text-info">Select User to Chat</h4>
            </div>
            @endif       
        </div>
        @script
        <script type="module" defer>
            Livewire.on('scroll-chat', () => {
                $wire.scrollDown()
            })
        </script>
        @endscript
    </div>
    <!-- /Chats View -->
    @if (!empty($user))
    <!-- Chat Right Sidebar -->
    <div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="task_window">
        <div class="chat-window video-window">
            <div class="fixed-header">
                <ul class="nav nav-tabs nav-tabs-bottom">
                    <li class="nav-item"><a class="nav-link active" href="#profile_tab" data-bs-toggle="tab">{{ __('Profile') }}</a></li>
                </ul>
            </div>
            <div class="tab-content chat-contents">
                <div class="content-full tab-pane show active" id="profile_tab">
                    <div class="display-table">
                        <div class="table-row">
                            <div class="table-body">
                                <div class="table-content">
                                    <div class="chat-profile-img">
                                        <div class="edit-profile-img">
                                            <img src="{{ !empty($user->avatar) ? asset('storage/users/'.$user->avatar): asset('images/user.jpg') }}" alt="{{ __('Avatar') }}">
                                            <span class="change-img">Change Image</span>
                                        </div>
                                        <h3 class="user-name m-t-10 mb-0">{{ $user->fullname }}</h3>
                                        @if (($user->type === \App\Enums\UserType::EMPLOYEE) && !empty($user->employeeDetail->designation))
                                        <small class="text-muted">{{ $user->employeeDetail->designation->name ?? '' }}</small>
                                        @endif
                                    </div>
                                    <div class="chat-profile-info">
                                        <ul class="user-det-list">
                                            @if (!empty($user->username))
                                            <li>
                                                <span>{{ __('Username') }}:</span>
                                                <span class="float-end text-muted">{{ $user->username }}</span>
                                            </li>
                                            @endif
                                            @if (!empty($user->dob))
                                                <li>
                                                    <span>{{ __('DOB') }}:</span>
                                                    <span class="float-end text-muted">{{ format_date($user->employeeDetail->dob) }}                                                    </span>
                                                </li>
                                            @endif
                                            @if (!empty($user->email))
                                            <li>
                                                <span>{{ __('Email') }}:</span>
                                                <span class="float-end text-muted">{{ $user->email }}</span>
                                            </li>
                                            @endif
                                            @if (!empty($user->phone))
                                            <li>
                                                <span>{{ __('Phone') }}:</span>
                                                <span class="float-end text-muted">{{ $user->phoneNumber }}</span>
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Chat Right Sidebar -->
    @endif
</div>
