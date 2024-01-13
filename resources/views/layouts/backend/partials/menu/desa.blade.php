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
        <a href="{{ route('admin.vendor.index') }}">
            <i data-feather="home"></i>
            <span>Vendor</span>
        </a>
    </li>
     <li>
        <a href="{{ route('admin.profile.desa') }}">
            <i data-feather="bar-chart-2"></i>
            <span>Profile Desa</span>
        </a>
    </li>
    <li>
        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
            <i data-feather="align-justify"></i>
            <span> Bukti Pengadaan </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEcommerce">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.surat-pesanan.index') }}">Surat Pesanan</a>
                </li>
                <li>
                    <a href="{{ route('admin.ba-barang.index') }}">BA Serah Terima Barang</a>
                </li>
                <li>
                    <a href="{{ route('admin.ba-pekerjaan.index') }}">BA Serah Terima Pekerjaan</a>
                </li>
            </ul>
        </div>
    </li>
</ul>