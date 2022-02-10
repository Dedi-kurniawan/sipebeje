<li class="nav-item" data-target-form="#accountForm">
    <a href="{{ route('admin.evaluasi-penawaran.edit', $paket->id) }}" class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "evaluasi-penawaran" ? "active" : "" }}">
        <i class="mdi mdi-file me-1"></i>
        <span class="d-none d-sm-inline">BA EVALUASI HARGA</span>
        <i class="mdi {{ $paket->evaluasi_field == "0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li>
<li class="nav-item" data-target-form="#profileForm">
    <a href="{{ route('admin.hasil-evaluasi-penawaran.edit', $paket->id) }}" class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "hasil-evaluasi-penawaran" ? "active" : "" }}">
        <i class="mdi mdi-file-sync me-1"></i>
        <span class="d-none d-sm-inline">HASIL EVALUASI PENAWARAN</span>
        <i class="mdi {{ $paket->hasil_evaluasi_field == "0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li>
<li class="nav-item" data-target-form="#profileForm">
    <a href="{{ route('admin.nego-harga.edit', $paket->id) }}"
        class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "nego-harga" ? "active" : "" }}">
        <i class="mdi mdi-file me-1"></i>
        <span class="d-none d-sm-inline">BA NEGO HARGA</span>
        <i class="mdi {{ $paket->nego_harga_field == " 0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li>
<li class="nav-item" data-target-form="#profileForm">
    <a href="{{ route('admin.surat-perjanjian.edit', $paket->id) }}"
        class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "surat-perjanjian" ? "active" : "" }}">
        <i class="mdi mdi-file-sync me-1"></i>
        <span class="d-none d-sm-inline">Surat Perjanjian</span>
        <i class="mdi {{ $paket->perjanjian_field == " 0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li>