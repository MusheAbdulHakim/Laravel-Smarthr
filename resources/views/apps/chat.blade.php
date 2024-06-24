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
                            <a href="admin-dashboard.html"><i class="la la-home"></i> <span>Back to Home</span></a>
                        </li>
                        <li class="menu-title"><span>Chat Groups</span> <a href="#" data-bs-toggle="modal"
                                data-bs-target="#add_group"><i class="fa-solid fa-plus"></i></a></li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/user.jpg" alt="User Image">
                                </span>
                                <span class="chat-user">#General</span>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/user.jpg" alt="User Image">
                                </span>
                                <span class="chat-user">#Video Responsive Survey</span>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/user.jpg" alt="User Image">
                                </span>
                                <span class="chat-user">#500rs</span>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/user.jpg" alt="User Image">
                                </span>
                                <span class="chat-user">#warehouse</span>
                            </a>
                        </li>
                        <li class="menu-title">Direct Chats <a href="#" data-bs-toggle="modal"
                                data-bs-target="#add_chat_user"><i class="fa-solid fa-plus"></i></a></li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/profiles/avatar-02.jpg"
                                        alt="User Image"><span class="status online"></span>
                                </span>
                                <span class="chat-user">John Doe</span> <span class="badge rounded-pill bg-danger">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/profiles/avatar-09.jpg"
                                        alt="User Image"><span class="status offline"></span>
                                </span>
                                <span class="chat-user">Richard Miles</span> <span
                                    class="badge rounded-pill bg-danger">7</span>
                            </a>
                        </li>
                        <li>
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/profiles/avatar-10.jpg"
                                        alt="User Image"><span class="status away"></span>
                                </span>
                                <span class="chat-user">John Smith</span>
                            </a>
                        </li>
                        <li class="active">
                            <a href="chat.html">
                                <span class="chat-avatar-sm user-img">
                                    <img class="rounded-circle" src="assets/img/profiles/avatar-05.jpg"
                                        alt="User Image"><span class="status online"></span>
                                </span>
                                <span class="chat-user">Mike Litorus</span> <span
                                    class="badge rounded-pill bg-danger">2</span>
                            </a>
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
                                        <img src="assets/img/profiles/avatar-05.jpg" alt="User Image"
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
                                                    <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
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
                                                    <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
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
                                                    <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
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
                                                    <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
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
                                                    <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
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
                        <div class="message-bar">
                            <div class="message-inner">
                                <a class="link attach-icon" href="#" data-bs-toggle="modal"
                                    data-bs-target="#drag_files"><img src="assets/img/attachment.png"
                                        alt="Attachment Icon"></a>
                                <div class="message-area">
                                    <div class="input-group">
                                        <textarea class="form-control" placeholder="Type message..."></textarea>
                                        <button class="btn btn-custom" type="button"><i
                                                class="fa-solid fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                    <img src="assets/img/profiles/avatar-05.jpg" alt="User Image">
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
    <!-- Drogfiles Modal -->
    <div id="drag_files" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Drag and drop files upload</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="js-upload-form">
                        <div class="upload-drop-zone" id="drop-zone">
                            <i class="fa fa-cloud-upload fa-2x"></i> <span class="upload-text">Just drag and drop files
                                here</span>
                        </div>
                        <h4>Uploading</h4>
                        <ul class="upload-list">
                            <li class="file-list">
                                <div class="upload-wrap">
                                    <div class="file-name">
                                        <i class="fa fa-photo"></i>
                                        photo.png
                                    </div>
                                    <div class="file-size">1.07 gb</div>
                                    <button type="button" class="file-close">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                                <div class="progress progress-xs progress-striped">
                                    <div class="progress-bar bg-success w-65" role="progressbar"></div>
                                </div>
                                <div class="upload-process">37% done</div>
                            </li>
                            <li class="file-list">
                                <div class="upload-wrap">
                                    <div class="file-name">
                                        <i class="fa fa-file"></i>
                                        task.doc
                                    </div>
                                    <div class="file-size">5.8 kb</div>
                                    <button type="button" class="file-close">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                                <div class="progress progress-xs progress-striped">
                                    <div class="progress-bar bg-success w-65" role="progressbar"></div>
                                </div>
                                <div class="upload-process">37% done</div>
                            </li>
                            <li class="file-list">
                                <div class="upload-wrap">
                                    <div class="file-name">
                                        <i class="fa fa-photo"></i>
                                        dashboard.png
                                    </div>
                                    <div class="file-size">2.1 mb</div>
                                    <button type="button" class="file-close">
                                        <i class="fa fa-close"></i>
                                    </button>
                                </div>
                                <div class="progress progress-xs progress-striped">
                                    <div class="progress-bar bg-success w-65" role="progressbar"></div>
                                </div>
                                <div class="upload-process">Completed</div>
                            </li>
                        </ul>
                    </form>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Drogfiles Modal -->

    <!-- Add Group Modal -->
    <div id="add_group" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create a group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Groups are where your team communicates. They’re best when organized around a topic — #leads, for
                        example.</p>
                    <form>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Group Name <span class="text-danger">*</span></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="input-block mb-3">
                            <label class="col-form-label">Send invites to: <span
                                    class="text-muted-light">(optional)</span></label>
                            <input class="form-control" type="text">
                        </div>
                        <div class="submit-section">
                            <button class="btn btn-primary submit-btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Group Modal -->

    <!-- Add Chat User Modal -->
    <div id="add_chat_user" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Direct Chat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group m-b-30">
                        <input placeholder="Search to start a chat" class="form-control search-input" type="text">
                        <button class="btn btn-primary">Search</button>
                    </div>
                    <div>
                        <h5>Recent Conversations</h5>
                        <ul class="chat-user-list">
                            <li>
                                <a href="#">
                                    <div class="chat-block d-flex">
                                        <span class="avatar align-self-center flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-16.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body align-self-center text-nowrap flex-grow-1">
                                            <div class="user-name">Jeffery Lalor</div>
                                            <span class="designation">Team Leader</span>
                                        </div>
                                        <div class="text-nowrap align-self-center">
                                            <div class="online-date">1 day ago</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="chat-block d-flex">
                                        <span class="avatar align-self-center flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-13.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body align-self-center text-nowrap flex-grow-1">
                                            <div class="user-name">Bernardo Galaviz</div>
                                            <span class="designation">Web Developer</span>
                                        </div>
                                        <div class="align-self-center text-nowrap">
                                            <div class="online-date">3 days ago</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <div class="chat-block d-flex">
                                        <span class="avatar align-self-center flex-shrink-0">
                                            <img src="assets/img/profiles/avatar-02.jpg" alt="User Image">
                                        </span>
                                        <div class="media-body text-nowrap align-self-center flex-grow-1">
                                            <div class="user-name">John Doe</div>
                                            <span class="designation">Web Designer</span>
                                        </div>
                                        <div class="align-self-center text-nowrap">
                                            <div class="online-date">7 months ago</div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Add Chat User Modal -->

    <!-- Share Files Modal -->
    <div id="share_files" class="modal custom-modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Share File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="files-share-list">
                        <div class="files-cont">
                            <div class="file-type">
                                <span class="files-icon"><i class="fa-regular fa-file-pdf"></i></span>
                            </div>
                            <div class="files-info">
                                <span class="file-name text-ellipsis">AHA Selfcare Mobile Application Test-Cases.xls</span>
                                <span class="file-author"><a href="#">Bernardo Galaviz</a></span> <span
                                    class="file-date">May 31st at 6:53 PM</span>
                            </div>
                        </div>
                    </div>
                    <div class="input-block mb-3">
                        <label class="col-form-label">Share With</label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Share</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Share Files Modal -->
@endsection


@push('page-scripts')
    <!-- Page Js -->
    <!-- /Page Js -->
@endpush
