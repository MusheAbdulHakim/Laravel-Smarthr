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


        <li class="nav-item dropdown has-arrow main-drop">
            <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                <span class="user-img"><img src="{{ !empty(auth()->user()->avatar) ? uploadedAsset(auth()->user()->avatar,'users'): asset('images/user.jpg') }}" alt="User Image">
                    <span class="status online"></span></span>
                <span>{{ auth()->user()->fullname }}</span>
            </a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="{{ route('profile') }}">{{ __('My Profile') }}</a>
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
