<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="{{ Request::routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{route('dashboard')}}"><i class="la la-dashboard"></i> <span> Dashboard</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-cube"></i> <span> Apps</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        
                        <li><a class="{{ Request::routeIs('contacts') ? 'active' : '' }}" href="{{route('contacts')}}">Contacts</a></li>
                        <li><a class="{{ Request::routeIs('filemanager') ? 'active' : '' }}" href="{{route('filemanager')}}">File Manager</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::routeIs('employees') ? 'active' : '' }}" href="{{route('employees')}}">All Employees</a></li>
                        <li><a class="{{ Request::routeIs('holidays') ? 'active' : '' }}" href="{{route('holidays')}}">Holidays</a></li>
                        
                        <li><a class="{{ Request::routeIs('leave-type') ? 'active' : '' }}" href="{{route('leave-type')}}">Leave Type</a></li>
                        <li><a class="{{ Request::routeIs('employee-leave') ? 'active' : '' }}" href="{{route('employee-leave')}}">Leaves (Employee)</a></li>
                        <li><a class="{{ Request::routeIs('departments') ? 'active' : '' }}" href="{{route('departments')}}">Departments</a></li>
                        <li><a class="{{ Request::routeIs('designations') ? 'active' : '' }}" href="{{route('designations')}}">Designations</a></li>
                        
                    </ul>
                </li>
                <li class="{{ Request::routeIs('clients') ? 'active' : '' }}">
                    <a href="{{route('clients')}}"><i class="la la-users"></i> <span>Clients</span></a>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="projects.html">Projects</a></li>
                        <li><a href="tasks.html">Tasks</a></li>
                        <li><a href="task-board.html">Task Board</a></li>
                    </ul>
                </li>
                
                
                <li class="{{ Request::routeIs('policies') ? 'active' : '' }}">
                    <a href="{{route('policies')}}"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
                </li>
                
                <li class="submenu">
                    <a href="#"><i class="la la-briefcase"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::routeIs('jobs') ? 'active' : '' }}" href="{{route('jobs')}}"> Manage Jobs </a></li>
                        <li><a class="{{ Request::routeIs('job-applicants') ? 'active' : '' }}" href="{{route('job-applicants')}}"> Applied Candidates </a></li>
                    </ul>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-crosshairs"></i> <span> Goals </span> <span class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::routeIs('goal-tracking') ? 'active' : '' }}" href="{{route('goal-tracking')}}"> Goal List </a></li>
                        <li><a class="{{ Request::routeIs('goal-type') ? 'active' : '' }}" href="{{route('goal-type')}}"> Goal Type </a></li>
                    </ul>
                </li>
                <li>
                    <a class="{{ Request::routeIs('activity') ? 'active' : '' }}" href="{{route('activity')}}"><i class="la la-bell"></i> <span>Activities</span></a>
                </li>
                <li class="{{ Request::routeIs('users') ? 'active' : '' }}">
                    <a href="{{route('users')}}"><i class="la la-user-plus"></i> <span>Users</span></a>
                </li>
              
                <li>
                    <a class="{{ Request::routeIs('settings') ? 'active' : '' }}" href="{{route('settings')}}"><i class="la la-cog"></i> <span>Settings</span></a>
                </li>
                
                
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->
