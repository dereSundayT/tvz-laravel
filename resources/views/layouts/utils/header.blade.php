<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('admin.dashboard')}}" class="logo d-flex align-items-center">
            <img src="{{asset('assets/img/logo.png')}}" alt=""/>
            <span class="d-none d-lg-block">{{config('app.name')}}</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->



    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li><!-- End Search Icon-->




            <li class="nav-item dropdown pe-3">

                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
{{--                    <img src="{{asset('assets/img/profile-img.jpg')}}" alt="Profile" class="rounded-circle">--}}
                    <img src="{{asset("storage/profile-image/$user->profile_photo")}}" alt="Profile" class="rounded-circle">
                    <span class="d-none d-md-block dropdown-toggle ps-2">
                        @if(auth('admin')->user())
                            {{auth('admin')->user()->name}}
                        @else
                            {{auth()->user()->name}}
                        @endif
                    </span>
                </a>
                <!-- End Profile Iamge Icon -->

                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        @if(auth('admin')->user())
                            <h6>{{auth('admin')->user()->name}}</h6>
                            <span>Admin</span>
                        @else
                            <h6>{{auth()->user()->name}}</h6>
                        @endif
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{route('home')}}">
                            <i class="bi bi-person"></i>
                            <span>Visit Homepage</span>
                        </a>
                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>
                        <a data-bs-toggle="modal" data-bs-target="#logout" class="dropdown-item d-flex align-items-center" href="#">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->

        </ul>
    </nav>
    <!-- End Icons Navigation -->

</header>

@include('layouts.utils.logout')
