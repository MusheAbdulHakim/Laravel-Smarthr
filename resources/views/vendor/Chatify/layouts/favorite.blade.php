<div class="favorite-list-item">
    @if($user)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ Chatify::getUserWithAvatar($user)->avatar }}');">
        </div>
        <p>{{ strlen($user->fullname) > 5 ? substr($user->fullname,0,6).'..' : $user->fullname }}</p>
    @endif
</div>
