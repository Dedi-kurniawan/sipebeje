<ul id="side-menu">
    <li class="menu-title">MAIN MENU</li>  
    <li>
        <a href="{{ route('admin.dashboard.index') }}">
            <i data-feather="airplay"></i>
            <span> Dashboard</span>
        </a>
    </li>
    <li>
        <a href="{{ route('admin.paket-admin.index') }}">
            <i data-feather="file-text"></i>
            <span>Paket</span>
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
    <li class="menu-title mt-2">MASTER</li>
    <li>
        <a href="#sidebarEcommerce" data-bs-toggle="collapse">
            <i data-feather="align-justify"></i>
            <span> Master </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarEcommerce">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.kecamatan.index') }}">Kecamatan</a>
                </li>
                <li>
                  <a href="{{ route('admin.desa.index') }}">Desa</a>
                </li>
                <li>
                  <a href="{{ route('admin.kategori.index') }}">Jenis Pengadaan/Usaha</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="menu-title mt-2">AUTH</li>
    <li>
        <a href="{{ route('admin.operator.index') }}">
            <i data-feather="home"></i>
            <span> Operator Desa</span>
        </a>
    </li>
</ul>