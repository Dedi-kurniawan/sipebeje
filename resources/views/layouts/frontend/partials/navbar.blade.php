<div class="navbar-custom" style="background-color:#3827c1">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">
            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            <li class="nav-item dropdown">
                @guest
                    <a class="nav-link arrow-none waves-effect waves-light" href="{{ route('frontend.login') }}">
                        <i class="fe-user noti-icon"></i> Login
                    </a>
                @else
                    <a class="nav-link arrow-none waves-effect waves-light" href="{{ route('admin.dashboard.index') }}">
                        <i class="fe-airplay noti-icon"></i> Dashboard
                    </a>
                @endguest                
            </li>
        </ul>
        <div class="logo-box">
            <a href="{{ url('/') }}" class="logo logo-dark text-center">
                <span class="logo-sm">
                    <img src="{{ asset('template/images/logo/logo-sm.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('template/images/logo/logo-dark.png') }}" alt="" height="35">
                </span>
            </a>
            <a href="{{ url('/') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('template/images/logo/logo-sm.png') }}" alt="" height="22">
                </span>
                <span class="logo-lg">
                    <img src="{{ asset('template/images/logo/logo-light.png') }}" alt="" height="35">
                </span>
            </a>
        </div>
        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>
            <li>
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
            </li>   
        </ul>
        <div class="clearfix"></div>
    </div>
</div>