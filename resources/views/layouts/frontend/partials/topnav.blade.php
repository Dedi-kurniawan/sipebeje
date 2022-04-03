<div class="topnav">
    <div class="container-fluid">
        <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
            <div class="collapse navbar-collapse" id="topnav-menu-content">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ url('/') }}">
                            <i class="fe-airplay me-1"></i> Beranda
                        </a>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ url('/') }}">
                            <i class="fe-search me-1"></i> Cari Paket
                        </a>
                    </li> --}}
                    <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('frontend.welcome.kontak') }}">
                            <i class="fe-book me-1"></i> Kontak Kami
                        </a>
                    </li>  
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link arrow-none" href="{{ route('frontend.register.index') }}">
                            <i class="fe-users me-1"></i> Daftar Vendor
                        </a>
                    </li>                                         --}}
                </ul> 
            </div> 
        </nav>
    </div> 
</div>