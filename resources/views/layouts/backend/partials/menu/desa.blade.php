<ul id="side-menu">
    <li class="menu-title">MAIN MENU</li>  
    <li>
        <a href="{{ route('admin.dashboard.index') }}">
            <i data-feather="airplay"></i>
            <span> Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.paket.index') }}">
            <i data-feather="file-text"></i>
            <span> Paket</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.aparatur.index') }}">
            <i data-feather="users"></i>
            <span> Aparatur Desa</span>
        </a>
    </li>
     <li>
        <a href="{{ route('admin.profile.desa') }}">
            <i data-feather="bar-chart-2"></i>
            <span>Profile Desa</span>
        </a>
    </li>
</ul>