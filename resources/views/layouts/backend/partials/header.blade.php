<div class="navbar-custom">
  <div class="container-fluid">
      <ul class="list-unstyled topnav-menu float-end mb-0"> 
          <li class="dropdown d-none d-lg-inline-block">
              <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                  <i class="fe-maximize noti-icon"></i>
              </a>
          </li>
          
          @if (Auth::user()->role == "vendor")
            @include('layouts.backend.partials.notifikasi')
          @endif
  
          <li class="dropdown notification-list topbar-dropdown">
              <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                  <img src="{{ asset('template/images/logo/blank.png') }}" alt="user-image" class="rounded-circle">
                  <span class="pro-user-name ms-1">
                      {{ Auth::user()->name }} <i class="mdi mdi-chevron-down"></i> 
                  </span>
              </a>
              <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                  <!-- item-->
                  <div class="dropdown-header noti-title">
                      <h6 class="text-overflow m-0">Welcome !</h6>
                  </div>
  
                  <!-- item-->
                  <a href="{{ route('admin.profile.akun') }}" class="dropdown-item notify-item">
                      <i class="fe-user"></i>
                      <span>My Account</span>
                  </a>

                  <div class="dropdown-divider"></div>
                  
                  <a href="{{ route('frontend.logout') }}" class="dropdown-item notify-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fe-log-out"></i>
                      <span>Logout</span>
                  </a>
                  <form id="logout-form" action="{{ route('frontend.logout') }}" method="POST" class="d-none">
                      @csrf
                  </form>
  
              </div>
          </li>  
      </ul>
      <div class="logo-box">
          <a href="index.html" class="logo logo-dark text-center">
              <span class="logo-sm">
                  <img src="{{ asset('template/images/logo/logo-sm.png') }}" alt="" height="22">
              </span>
              <span class="logo-lg">
                    <img src="{{ asset('template/images/logo/logo-dark.png') }}" alt="" height="35">
              </span>
          </a>
  
          <a href="index.html" class="logo logo-light text-center">
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