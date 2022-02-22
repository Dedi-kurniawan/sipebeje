<ul id="side-menu">
    <li class="menu-title">MAIN MENU</li>  
    <li>
        <a href="{{ route('admin.dashboard.index') }}">
            <i data-feather="airplay"></i>
            <span> Dashboard</span>
        </a>
    </li>
    {{-- <li>
        <a href="{{ route('admin.paket-vendor.index') }}">
            <i data-feather="file-text"></i>
            <span>Paket</span>
        </a>
    </li> --}}
    <li>
        <a href="{{ route('admin.undangan.paket') }}">
            <i data-feather="send"></i>
            <span>Undangan</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.profile.vendor') }}">
            <i data-feather="bar-chart-2"></i>
            <span>Profile Perusahaan</span>
        </a>
    </li>
</ul>