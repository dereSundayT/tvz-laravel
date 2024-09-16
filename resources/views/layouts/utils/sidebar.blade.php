<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        @if(auth('admin')->user())
            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/dashboard') ? '' : 'collapsed' }} " href="{{route('admin.dashboard')}}">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('admin/users') ? '' : 'collapsed' }} " href="{{route('admin.users')}}">
                    <i class="bi bi-person"></i>
                    <span>Users</span>
                </a>
            </li>
        @else
            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#" aria-expanded="false">
                    <i class="bi bi-journal-text"></i><span>Home</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse" data-bs-parent="#sidebar-nav" style="">
                    <li>
                        <a href="{{route('panel.followers')}}">
                            <i class="bi bi-circle"></i><span>My Followers</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('panel.following')}}">
                            <i class="bi bi-circle"></i><span>Following</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ request()->is('panel/profile') ? '' : 'collapsed' }} " href="{{route('panel.profile')}}">
                    <i class="bi bi-person"></i>
                    <span>Profile</span>
                </a>
            </li>
        @endif




        {{--        --}}

    </ul>

</aside>
