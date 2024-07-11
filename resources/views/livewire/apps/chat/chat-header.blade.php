<div>
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
</div>
