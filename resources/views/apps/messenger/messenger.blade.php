@extends('apps.messenger.app')

@section('chat-page-content')
{{-- <div id="message_sidebar_container">
    <div class="card h-100">
        <div class="card-header px-1 d-flex justify-content-between">
            <div id="my_avatar_status">
                <span class="avatar">
                    <img data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="You are {{\Illuminate\Support\Str::lower(\RTippin\Messenger\Contracts\MessengerProvider::ONLINE_STATUS[messenger()->getProvider()->getProviderOnlineStatus()])}}"
                    class="my-global-avatar ml-1 rounded-circle medium-image avatar-is-{{\Illuminate\Support\Str::lower(\RTippin\Messenger\Contracts\MessengerProvider::ONLINE_STATUS[messenger()->getProvider()->getProviderOnlineStatus()])}}"
                    src="{{messenger()->getProvider()->getProviderAvatarRoute()}}" />
                </span>
            </div>
            <div class="dropdown dropdown-action">
                <a href="#" class="action-icon dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <i data-bs-tooltip="tooltip" data-bs-title="Messenger Options" data-bs-placement="right" class="material-icons">more_vert</i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item text-dark" onclick="ThreadManager.load().search(); return false;" href="#"> Search Profiles</a>
                    <a class="dropdown-item text-dark" onclick="ThreadManager.load().createGroup(); return false;" href="#">Create Group</a>
                    <a class="dropdown-item text-dark" onclick="ThreadManager.load().contacts(); return false;" href="#">Friends</a>
                    <a class="dropdown-item text-dark" onclick="MessengerSettings.show(); return false;" href="#">Settings</a>
                </div>
            </div>
        </div>
        <div data-simplebar id="message_sidebar_content" class="card-body px-0 py-0">
            <div class="col-12 px-2 mx-0 py-0">
                <div id="socket_error"></div>
                <div id="threads_search_bar" class="NS my-2">
                    <div class="form-row">
                        <div class="input-group input-group-sm col-12 mb-0">
                            <div class="input-group-prepend">
                                <div class="input-group-text"><i class="fas fa-search"></i></div>
                            </div>
                            <input autocomplete="off" type="search" class="form-control shadow-sm" id="thread_search_input" placeholder="Search conversations by name"/>
                        </div>
                    </div>
                </div>
                <div id="allThread">
                    <ul id="messages_ul" class="messages-list">
                        <div class="col-12 mt-5 text-center"><div class="spinner-grow spinner-grow-sm text-primary" role="status"></div></div>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<div id="message_container" class="chat-window">
    <div class="spinner-grow spinner-grow-sm text-primary" role="status"></div>
    <div id="drag_drop_overlay" class="drag_drop_overlay rounded text-center NS">
        <div class="h-100 d-flex justify-content-center">
            <div class="align-self-center h1">
                <span class="badge badge-pill badge-primary"><i class="fas fa-cloud-upload-alt"></i> Drop files to upload</span>
            </div>
        </div>
    </div>
</div>
@stop