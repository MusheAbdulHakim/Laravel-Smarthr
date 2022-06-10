<div class="header">
			
    <!-- Logo -->
    <div class="header-left">
        <a href="" class="logo">
            <img src="{{!empty(app(App\Settings\ThemeSettings::class)->logo) ? asset('storage/settings/'.app(App\Settings\ThemeSettings::class)->logo):asset('assets/img/logo.png')}}" width="40" height="40" alt="logo">
        </a>
    </div>
    <!-- /Logo -->
    
    <!-- Header Title -->
    <div class="page-title-box float-left">
        <h3>{{ucfirst(app(App\Settings\CompanySettings::class)->company_name ?? config('app.name'))}}</h3>
    </div>
    <!-- /Header Title -->
    
    <!-- Header Menu -->
    <ul class="nav user-menu">
    
        <!-- Search -->
        <li class="nav-item">
            <div class="top-nav-search">
                <a href="javascript:void(0);" class="responsive-search">
                    <i class="fa fa-search"></i>
               </a>
                <form action="">
                    <input class="form-control" type="text" placeholder="Search here">
                    <button class="btn" type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>
        </li>
        <!-- /Search -->
        @if (!Request::RouteIs('job-list'))   
            <li class="nav-item">
                <a href="{{route('job-list')}}" class="nav-link">Jobs</a>
            </li>
        @endif
        
        <li class="nav-item">
            <a class="nav-link" href="{{route('login')}}">Login</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('register')}}">Register</a>
        </li>
    </ul>
    <!-- /Header Menu -->

    <!-- Mobile Menu -->
    <div class="dropdown mobile-user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-ellipsis-v"></i></a>
        <div class="dropdown-menu dropdown-menu-right">
            <a class="dropdown-item" href="{{route('login')}}">Login</a>
            <a class="dropdown-item" href="{{route('register')}}">Register</a>
        </div>
    </div>
    <!-- /Mobile Menu -->
    
</div>