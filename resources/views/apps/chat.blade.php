@extends('layouts.app')

@push('page-styles')
    <!-- Page Css -->
    <!-- /Page Css -->
@endpush

@section('sidebar')
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <nav class="greedy">
                    <ul class="link-item">
                        <li>
                            <a href="{{ route('dashboard') }}"><i class="la la-home"></i> <span>Back to Home</span></a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- /Sidebar -->
@endsection

@section('page-content')
    <!-- Chat Main Row -->
    <div class="chat-main-row">

        <!-- Chat Main Wrapper -->
        <div class="chat-main-wrapper">

            <!-- Chats View -->
            <div class="col-lg-9 message-view task-view">
                <div class="chat-window">
                    <div class="fixed-header">
                        <div class="navbar">
                            <div class="user-details me-auto">
                                <div class="float-start user-img">
                                    <a class="avatar" href="profile.html" title="Mike Litorus">
                                        <img src="{{ asset('images/user.jpg') }}" alt="User Image"
                                            class="rounded-circle">
                                        <span class="status online"></span>
                                    </a>
                                </div>
                                <div class="user-info float-start">
                                    <a href="profile.html" title="Mike Litorus"><span>Mike Litorus</span> <i
                                            class="typing-text">Typing...</i></a>
                                    <span class="last-seen">Last seen today at 7:50 AM</span>
                                </div>
                            </div>
                            <div class="search-box">
                                <div class="input-group input-group-sm">
                                    <input type="text" placeholder="Search" class="form-control">
                                    <button type="button" class="btn"><i
                                            class="fa-solid fa-magnifying-glass"></i></button>
                                </div>
                            </div>
                            <ul class="nav custom-menu">
                                <li class="nav-item">
                                    <a class="nav-link task-chat profile-rightbar float-end" id="task_chat"
                                        href="#task_window"><i class="fa-solid fa-user"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="voice-call.html" class="nav-link"><i class="fa-solid fa-phone"></i></a>
                                </li>
                                <li class="nav-item">
                                    <a href="video-call.html" class="nav-link"><i class="fa-solid fa-video"></i></a>
                                </li>
                                <li class="nav-item dropdown dropdown-action">
                                    <a aria-expanded="false" data-bs-toggle="dropdown" class="nav-link dropdown-toggle"
                                        href=""><i class="fa-solid fa-gear"></i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a href="javascript:void(0)" class="dropdown-item">Delete Conversations</a>
                                        <a href="javascript:void(0)" class="dropdown-item">Settings</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="chat-contents">
                        <div class="chat-content-wrap">
                            <div class="chat-wrap-inner">
                                <div class="chat-box">
                                    <div class="chats">
                                        <div class="chat chat-right">
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Hello. What can I do for you?</p>
                                                        <span class="chat-time">8:30 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-line">
                                            <span class="chat-date">October 8th, 2018</span>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>I'm just looking around.</p>
                                                        <p>Will you tell me something about yourself? </p>
                                                        <span class="chat-time">8:35 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Are you there? That time!</p>
                                                        <span class="chat-time">8:40 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-right">
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Where?</p>
                                                        <span class="chat-time">8:35 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>OK, my name is Limingqiang. I like singing, playing
                                                            basketballand so on.</p>
                                                        <span class="chat-time">8:42 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>You wait for notice.</p>
                                                        <span class="chat-time">8:30 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Consectetuorem ipsum dolor sit?</p>
                                                        <span class="chat-time">8:50 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>OK?</p>
                                                        <span class="chat-time">8:55 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content img-content">
                                                        <div class="chat-img-group clearfix">
                                                            <p>Uploaded 3 Images</p>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <span class="chat-time">9:00 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-right">
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>OK!</p>
                                                        <span class="chat-time">9:00 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Uploaded 3 files</p>
                                                        <ul class="attach-list">
                                                            <li><i class="fa fa-file"></i> <a
                                                                    href="#">example.avi</a></li>
                                                            <li><i class="fa fa-file"></i> <a
                                                                    href="#">activity.psd</a></li>
                                                            <li><i class="fa fa-file"></i> <a
                                                                    href="#">example.psd</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Consectetuorem ipsum dolor sit?</p>
                                                        <span class="chat-time">8:50 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>OK?</p>
                                                        <span class="chat-time">8:55 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-right">
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content img-content">
                                                        <div class="chat-img-group clearfix">
                                                            <p>Uploaded 6 Images</p>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                            <a class="chat-img-attach" href="#">
                                                                <img width="182" height="137"
                                                                    src="assets/img/placeholder.jpg"
                                                                    alt="Placeholder Image">
                                                                <div class="chat-placeholder">
                                                                    <div class="chat-img-name">placeholder.jpg</div>
                                                                    <div class="chat-file-desc">842 KB</div>
                                                                </div>
                                                            </a>
                                                        </div>
                                                        <span class="chat-time">9:00 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <ul class="attach-list">
                                                            <li class="pdf-file"><i class="fa-regular fa-file-pdf"></i> <a
                                                                    href="#">Document_2016.pdf</a></li>
                                                        </ul>
                                                        <span class="chat-time">9:00 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-right">
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <ul class="attach-list">
                                                            <li class="pdf-file"><i class="fa-regular fa-file-pdf"></i> <a
                                                                    href="#">Document_2016.pdf</a></li>
                                                        </ul>
                                                        <span class="chat-time">9:00 am</span>
                                                    </div>
                                                    <div class="chat-action-btns">
                                                        <ul>
                                                            <li><a href="#" class="share-msg" title="Share"><i
                                                                        class="fa-solid fa-share-nodes"></i></a></li>
                                                            <li><a href="#" class="edit-msg"><i
                                                                        class="fa-solid fa-pencil"></i></a></li>
                                                            <li><a href="#" class="del-msg"><i
                                                                        class="fa-regular fa-trash-can"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <p>Typing ...</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="chat-footer">
                        <form autocomplete="off" id="thread_form">
                            <div class="message-bar">
                                <div class="message-inner">
                                    {{-- <a class="link attach-icon" href="#" data-bs-toggle="modal"
                                        data-bs-target="#drag_files">
                                        <img src="images/attachment.png"
                                            alt="Attachment Icon">
                                    </a> --}}
                                    <button id="file_upload_btn" data-bs-toggle="tooltip" data-bs-title="Upload File(s)" data-bs-placement="top" class="link attach-icon p-1 btn btn-sm" onclick="$('#doc_file).trigger('click');" type="button"><i class="fa-solid fa-paperclip"></i></button>
                                    <button id="record_audio_message_btn" data-toggle="tooltip" title="Record Audio Message" data-placement="top" class="p-1 mx-1 btn btn-sm btn-light" type="button"><i class="fas fa-microphone"></i></button>
                                    <div class="message-area">
                                        <div class="input-group">
                                            <textarea autocomplete="off" spellcheck="true" title="message" name="message_txt_'+Date.now()+'" id="message_text_input" class="form-control" placeholder="Type message..."></textarea>
                                            <button class="btn btn-custom" type="button"><i class="fa-solid fa-paper-plane"></i></button>
                                            <button id="add_emoji_btn" data-bs-toggle="tooltip" data-bs-title="Add Emoji" data-bs-placement="top" class="p-1 mx-1 btn btn-sm btn-custom" type="button"><i class="fas fa-grin"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <input class="NS" multiple type="file" name="doc_file" id="doc_file">
                    <input class="NS" id="thread_avatar_image_file" type="file" name="group_avatar_image_file" accept="image/*">
                </div>
            </div>
            <!-- /Chats View -->

            <!-- Chat Right Sidebar -->
            <div class="col-lg-3 message-view chat-profile-view chat-sidebar" id="task_window">
                <div class="chat-window video-window">
                    <div class="fixed-header">
                        <ul class="nav nav-tabs nav-tabs-bottom">
                            <li class="nav-item"><a class="nav-link" href="#calls_tab" data-bs-toggle="tab">Calls</a>
                            </li>
                            <li class="nav-item"><a class="nav-link active" href="#profile_tab"
                                    data-bs-toggle="tab">Profile</a></li>
                        </ul>
                    </div>
                    <div class="tab-content chat-contents">
                        <div class="content-full tab-pane" id="calls_tab">
                            <div class="chat-wrap-inner">
                                <div class="chat-box">
                                    <div class="chats">
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="{{ route('profile') }}" class="avatar">
                                                    <img src="{{ !empty($user->avatar) ? asset('storage/users/' . $user->avatar) : asset('assets/img/user.jpg') }}"
                                                        alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <span class="task-chat-user">You</span> <span
                                                            class="chat-time">8:35 am</span>
                                                        <div class="call-details">
                                                            <i class="material-icons">phone_missed</i>
                                                            <div class="call-info">
                                                                <div class="call-user-details">
                                                                    <span class="call-description">Jeffrey Warden
                                                                        missed the call</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <span class="task-chat-user">John Doe</span> <span
                                                            class="chat-time">8:35 am</span>
                                                        <div class="call-details">
                                                            <i class="material-icons">call_end</i>
                                                            <div class="call-info">
                                                                <div class="call-user-details"><span
                                                                        class="call-description">This call has
                                                                        ended</span></div>
                                                                <div class="call-timing">Duration: <strong>5 min 57
                                                                        sec</strong></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat-line">
                                            <span class="chat-date">January 29th, 2019</span>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <span class="task-chat-user">Richard Miles</span> <span
                                                            class="chat-time">8:35 am</span>
                                                        <div class="call-details">
                                                            <i class="material-icons">phone_missed</i>
                                                            <div class="call-info">
                                                                <div class="call-user-details">
                                                                    <span class="call-description">You missed the
                                                                        call</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="chat chat-left">
                                            <div class="chat-avatar">
                                                <a href="profile.html" class="avatar">
                                                    <img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
                                                </a>
                                            </div>
                                            <div class="chat-body">
                                                <div class="chat-bubble">
                                                    <div class="chat-content">
                                                        <span class="task-chat-user">You</span> <span
                                                            class="chat-time">8:35 am</span>
                                                        <div class="call-details">
                                                            <i class="material-icons">ring_volume</i>
                                                            <div class="call-info">
                                                                <div class="call-user-details">
                                                                    <a href="#"
                                                                        class="call-description call-description--linked"
                                                                        data-qa="call_attachment_link">Calling John
                                                                        Smith ...</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="content-full tab-pane show active" id="profile_tab">
                            <div class="display-table">
                                <div class="table-row">
                                    <div class="table-body">
                                        <div class="table-content">
                                            <div class="chat-profile-img">
                                                <div class="edit-profile-img">
                                                    <img src="{{ !empty($user->avatar) ? asset('storage/users/' . $user->avatar) : asset('assets/img/user.jpg') }}"
                                                        alt="User Image">
                                                    <span class="change-img">Change Image</span>
                                                </div>
                                                <h3 class="user-name m-t-10 mb-0">{{ $user->fullName }}</h3>
                                                @if ($user->type === 'employee')
                                                    <small class="text-muted">Web Designer</small>
                                                @endif
                                                <a data-remote="true" data-bs-toggle="modal"
                                                    data-title="Profile Information" data-size="lg"
                                                    href="{{ route('profile.edit') }}" class="btn btn-primary edit-btn"><i
                                                        class="fa-solid fa-pencil"></i></a>
                                            </div>
                                            <div class="chat-profile-info">
                                                <ul class="user-det-list">
                                                    @if (!empty($user->username))
                                                        <li>
                                                            <span>{{ __('Username') }}:</span>
                                                            <span class="float-end text-muted">{{ $user->username }}</span>
                                                        </li>
                                                    @endif
                                                    </li>
                                                    @if (!empty($user->dob))
                                                        <li>
                                                            <span>{{ __('DOB') }}:</span>
                                                            <span class="float-end text-muted">{{ $user->dob }}</span>
                                                        </li>
                                                    @endif
                                                    @if (!empty($user->phone))
                                                        <li>
                                                            <span>{{ __('Phone') }}:</span>
                                                            <span
                                                                class="float-end text-muted">{{ $user->phoneNumber }}</span>
                                                        </li>
                                                    @endif
                                                    @if (!empty($user->email))
                                                        <li>
                                                            <span>{{ __('Email') }}:</span>
                                                            <span class="float-end text-muted">{{ $user->email }}</span>
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

        </div>
        <!-- /Chat Main Wrapper -->

    </div>
    <!-- /Chat Main Row -->
    
@endsection

@section('vendor-scripts')
@vite("resources/js/messenger/app.js")
@if(auth()->check())
<script src="https://cdn.jsdelivr.net/npm/emoji-toolkit@6.5.1/lib/js/joypixels.min.js"></script>
@endif
@stack('special-js')
<script type="module">
    $(document).ready(function(){
        $('html').attr('data-sidebar-size','sm-hover')
        Messenger.init({
            load : {
                NotifyManager : {
                    notify_sound : {{messenger()->getProviderMessenger()->notify_sound ? 'true' : 'false'}},
                    message_popups : {{messenger()->getProviderMessenger()->message_popups ? 'true' : 'false'}},
                    message_sound : {{messenger()->getProviderMessenger()->message_sound ? 'true' : 'false'}},
                    call_ringtone_sound : {{messenger()->getProviderMessenger()->call_ringtone_sound ? 'true' : 'false'}},
                },
                @stack('Messenger-load')
            },
            provider : {
                id : {{messenger()->getProvider()->getKey()}},
                model : '{{messenger()->getProvider()->getMorphClass()}}',
                alias : '{{messenger()->getProviderAlias()}}',
                name : '{{ messenger()->getProvider()->getProviderName()}}',
                slug : '{{ messenger()->getProvider()->getProviderAvatarRoute('sm')}}',
                avatar_md : '{{ messenger()->getProvider()->getProviderAvatarRoute('md')}}',
                avatar_sm : '{{ messenger()->getProvider()->getProviderAvatarRoute('sm')}}',
            },
            common : {
                app_name : '{{config('messenger-ui.site_name')}}',
                api_endpoint : '{{messenger()->getApiEndpoint()}}',
                web_endpoint : '{{'/'.config('messenger-ui.routing.prefix')}}',
                socket_endpoint : '{{config('messenger-ui.websocket.host')}}',
                socket_auth_endpoint : '{{config('messenger-ui.websocket.auth_endpoint')}}',
                socket_key : '{{config('messenger-ui.websocket.key')}}',
                socket_port : {{config('messenger-ui.websocket.port')}},
                socket_tls : {{config('messenger-ui.websocket.use_tsl') ? 'true' : 'false'}},
                socket_cluster : '{{config('messenger-ui.websocket.cluster')}}',
                socket_pusher : {{config('messenger-ui.websocket.pusher') ? 'true' : 'false'}},
                base_css : '{{ asset(mix('app.css', 'vendor/messenger')) }}',
                dark_css : '{{ asset(mix('dark.css', 'vendor/messenger')) }}',
                dark_mode : {{messenger()->getProviderMessenger()->dark_mode ? 'true' :  'false'}},
                mobile : false,
            },
            modules : {
                @stack('Messenger-modules')
            },
            @stack('Messenger-call')
        }, '{{config('app.env')}}');
    })
</script>
@endsection