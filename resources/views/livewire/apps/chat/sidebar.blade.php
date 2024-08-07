<div>
    <li>
        <div class="input-group m-b-30">
            <input placeholder="Search ..." class="form-control search-input" wire:model.live.debounce.250ms="searchQuery" type="search">
        </div>
    </li>
    @if (!empty($users) && ($users->count() > 0))
        @foreach ($users as $user)
        @if ($user->id !== auth()->user()->id)
        <li>
            <a href="{{ route('app.chat').'?contact='.\Crypt::encrypt($user->id) }}">
                <span class="chat-avatar-sm user-img">
                    <img class="rounded-circle" src="{{ !empty($user->avatar) ? asset('storage/users/'.$user->avatar): asset('images/user.jpg') }}" alt="{{ __('avatar') }}">
                </span> 
                @php
                $fullname = "$user->firstname $user->middlename $user->lastname";
            @endphp
            <span class="chat-user">{{ strlen($fullname) > 12 ? trim(substr($fullname,0,12)).'..' : $fullname }}</span>
            </a>
        </li>
        @endif
        @endforeach
    @endif
    <hr>
    
    @if (!empty($chats) && $chats->count() > 0)
    @foreach ($chats as $user)
    @php
        $contactId = \Crypt::encrypt($user->id);
        $requestContact = request()->input('contact');
        $unreadMessages = \App\Models\ChatMessage::where('user_id', $user->id)
                        ->where('receiver_id', auth()->user()->id)
                        ->where('is_read', false)->count();
    @endphp
    <li class="{{ !empty($requestContact) && ($user->id == \Crypt::decrypt($requestContact)) ? 'active': '' }}">
        <a href="{{ route('app.chat').'?contact='.$contactId }}">
            <span class="chat-avatar-sm user-img">
                <img class="rounded-circle" src="{{ !empty($user->avatar) ? asset('storage/users/'.$user->avatar): asset('images/user.jpg') }}" alt="{{ __('avatar') }}">
                @if (!empty($user->is_online)) 
                <span class="status online"></span> 
                @else
                <span class="status offline"></span>
                @endif
            </span> 
            @php
                $fullname = "$user->firstname $user->middlename $user->lastname";
            @endphp
            <span class="chat-user">{{ strlen($fullname) > 12 ? trim(substr($fullname,0,12)).'..' : $fullname }}</span> 
            @if ($unreadMessages > 0)
            <span class="badge rounded-pill bg-danger">{{ $unreadMessages ?? 0 }}</span>
            @endif
        </a>
    </li>
    @endforeach
    @endif
</div>
