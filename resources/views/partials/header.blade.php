<div class="header">

    <!-- Logo -->
    <x-logo />
    <!-- /Logo -->

    <a id="toggle_btn" href="javascript:void(0);">
        <span class="bar-icon">
            <span></span>
            <span></span>
            <span></span>
        </span>
    </a>

    <!-- Header Title -->
    <div class="page-title-box">
        <h3>{{ Theme('name') ?? config('app.name') }}</h3>
    </div>
    <!-- /Header Title -->

    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

    <!-- Header Menu -->
    <ul class="nav user-menu">

        <!-- Search -->
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </a>
                <form action="">
                    <input class="form-control" type="text" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
        </li>
        <!-- /Search -->

        <!-- Flag -->
        <li class="nav-item dropdown has-arrow flag-nav">
            <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button">
                <img src="{{ asset('images/flags/us.png') }}" alt="Flag" height="20"> <span>English</span>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('images/flags/us.png') }}" alt="Flag" height="16"> English
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('images/flags/fr.png') }}" alt="Flag" height="16"> French
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('images/flags/es.png') }}" alt="Flag" height="16"> Spanish
                </a>
                <a href="javascript:void(0);" class="dropdown-item">
                    <img src="{{ asset('images/flags/de.png') }}" alt="Flag" height="16"> German
                </a>
            </div>
        </li>
        <!-- /Flag -->

        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="fa-regular fa-bell"></i> <span class="badge rounded-pill">3</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        <li class="notification-message">
                            <a href="activities.html">
                                <div class="chat-block d-flex">
                                    <span class="avatar flex-shrink-0">
                                        <img src="{{ asset('images/user.jpg') }}" alt="User Image">
                                    </span>
                                    <div class="media-body flex-grow-1">
                                        <p class="noti-details"><span class="noti-title">John Doe</span> added new task
                                            <span class="noti-title">Patient appointment booking</span>
                                        </p>
                                        <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="activities.html">View all Notifications</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->

        <!-- Message Notifications -->
        @php
            $unreadMessages = auth()->user()->messengerInbox->where('seen',0);
        @endphp
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <i class="fa-regular fa-comment"></i> <span class="badge rounded-pill">{{ $unreadMessages->count() ?? 0 }}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="noti-content">
                    <ul class="notification-list">
                        @if (!empty($unreadMessages) && ($unreadMessages->count() > 0))
                            @foreach ($unreadMessages as $message)
                            <li class="notification-message">
                                <a href="{{ url('apps/chatify/') }}">
                                    <div class="list-item">
                                        <div class="list-left">
                                            <span class="avatar">
                                                <img src="{{ !empty($message->sender->avatar) ? asset('storage/users/'.$message->sender->avatar): asset('images/user.jpg') }}" alt="{{ $message->from->username ?? 'Avatar' }}">
                                            </span>
                                        </div>
                                        <div class="list-body">
                                            <span class="message-author">{{ $message->sender->fullname }} </span>
                                            <span class="message-time">{{ \Carbon\Carbon::parse($message->created_at)->diffForHumans() }}</span>
                                            <div class="clearfix"></div>
                                            <span class="message-content">{{ $message->body }}</span>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href={{ url('apps/chatify') }}">View all Messages</a>
                </div>
            </div>
        </li>
        <!-- /Message Notifications -->

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ !empty(auth()->user()->avatar) ? uploadedAsset(auth()->user()->avatar,'users'): asset('images/user.jpg') }}" alt="User Image">
                    <span class="status online"></span></span>
                <span>Admin</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>
                <a onclick="document.getElementById('logout_user_form').submit()" class="dropdown-item logout_btn" href="javascript:void(0);">Logout</a>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i
                class="fa-solid fa-ellipsis-vertical"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="profile.html">My Profile</a>
            <a onclick="document.getElementById('logout_user_form').submit()" class="dropdown-item logout_btn" href="javascript:void(0);">Logout</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
    <form action="{{ route('logout') }}" id="logout_user_form" method="post">@csrf</form>

</div>
