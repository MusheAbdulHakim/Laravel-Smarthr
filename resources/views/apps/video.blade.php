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

            <iframe
                allow="camera; microphone; display-capture; fullscreen; clipboard-read; clipboard-write; autoplay"
                src="https://c2c.mirotalk.com"
                style="height: 100vh; width: 100vw; border: 0px;"
            ></iframe>

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
