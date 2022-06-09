<!-- Header -->
<div class="header">
			
    <!-- Logo -->
    <div class="header-left">
        <a href="{{route('dashboard')}}" class="logo">
            <img src="{{!empty(app(App\Settings\ThemeSettings::class)->logo) ? asset('storage/settings/'.app(App\Settings\ThemeSettings::class)->logo):asset('assets/img/logo.png')}}" alt="logo" width="40" height="40">
        </a>
    </div>
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
        <h3>{{ucwords(app(App\Settings\CompanySettings::class)->company_name ?? 'Smart HR')}}</h3>
    </div>
    <!-- /Header Title -->
    
    <a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa fa-bars"></i></a>
    
    <!-- Header Menu -->
    <ul class="nav user-menu">
    
        <!-- Notifications -->
        <li class="nav-item dropdown">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <i class="fa fa-bell-o"></i> <span class="badge badge-pill">{{auth()->user()->notifications->count()}}</span>
            </a>
            <div class="dropdown-menu notifications">
                <div class="topnav-dropdown-header">
                    <span class="notification-title">Notifications</span>
                    <a href="{{route('clear-all')}}" class="clear-noti"> Clear All </a>
                </div>
                <div class="noti-content">
                    <ul class="notification-list">
                        @foreach (auth()->user()->unreadNotifications as $notification)
                            <li class="notification-message">
                                <a href="{{route('activity')}}">
                                    <div class="media">
                                        <span class="avatar">
                                            <img alt="user" src="{{asset('storage/users/'.auth()->user()->avatar)}}">
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">{{auth()->user()->name}}</span> {{$notification->type}}
                                                 <span class="noti-title">This is the notification body</span></p>
                                            <p class="noti-time"><span class="notification-time">{{$notification->created_at->diffForHumans()}}</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="{{route('activity')}}">View all Notifications</a>
                </div>
            </div>
        </li>
        <!-- /Notifications -->
        
        

        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                <span class="user-img"><img src="{{!empty(auth()->user()->avatar) ? asset('storage/users/'.auth()->user()->avatar) : asset('assets/img/user.jpg')}}" alt="user">
                <span class="status online"></span></span>
                <span>{{auth()->user()->username}}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
                <a class="dropdown-item" href="{{route('settings.theme')}}">Settings</a>
                <form action="{{route('logout')}}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">Logout</button>
                </form>
            </div>
        </li>
    </ul>
    <!-- /Header Menu -->
    
    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('profile')}}">My Profile</a>
            <a class="dropdown-item" href="{{route('settings.theme')}}">Settings</a>
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type="submit" class="dropdown-item">Logout</button>
            </form>
        </div>
    </div>
    <!-- /Mobile Menu -->
    
</div>
<!-- /Header -->