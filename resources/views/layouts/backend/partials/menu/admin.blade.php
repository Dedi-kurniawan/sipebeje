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
    <li>
        <a href="#sidebarPengadaan" data-bs-toggle="collapse">
            <i data-feather="align-justify"></i>
            <span> Bukti Pengadaan </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="sidebarPengadaan">
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
                <li>
                    <a href="{{ route('admin.satuan.index') }}">Satuan</a>
                </li>
            </ul>
        </div>
    </li>
    <li class="menu-title mt-2">Laporan</li>
    <li>
        <a href="#laporan" data-bs-toggle="collapse">
            <i data-feather="align-justify"></i>
            <span> Laporan </span>
            <span class="menu-arrow"></span>
        </a>
        <div class="collapse" id="laporan">
            <ul class="nav-second-level">
                <li>
                    <a href="{{ route('admin.laporan.index') }}">Laporan</a>
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