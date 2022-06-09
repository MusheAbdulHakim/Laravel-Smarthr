<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div class="sidebar-menu">
            <ul>
                <li> 
                    <a href="{{route('dashboard')}}"><i class="la la-home"></i> <span>Back to Home</span></a>
                </li>
                <li class="menu-title">Settings</li>
                <li class="{{ Request::routeIs('settings') ? 'active' : '' }}"> 
                    <a href="{{route('settings')}}"><i class="la la-cogs"></i> <span>Company Settings</span></a>
                </li>
                
               
                <li class="{{ Request::routeIs('change-password') ? 'active' : '' }}"> 
                    <a href="{{route('change-password')}}"><i class="la la-lock"></i> <span>Change Password</span></a>
                </li>
                
            </ul>
        </div>
    </div>
</div>
<!-- Sidebar -->