<li class="nav-item" data-target-form="#accountForm">
    <a href="{{ route('admin.paket.edit', $edit->id) }}" class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "paket" ? "active" : "" }}">
        <i class="mdi mdi-file me-1"></i>
        <span class="d-none d-sm-inline">PAKET</span>
    </a>
</li>
<li class="nav-item" data-target-form="#profileForm">
    <a href="{{ route('admin.akk.edit', $edit->id) }}" class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "akk" ? "active" : "" }}">
        <i class="mdi mdi-file-sync me-1"></i>
        <span class="d-none d-sm-inline">KERANGKA ACUAN KERJA (KAK)</span>
        <i class="mdi {{ $edit->akk_field == "0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li>
{{-- <li class="nav-item" data-target-form="#otherForm">
    <a href="{{ route('admin.hps.edit', $edit->id) }}" class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "hps" ? "active" : "" }}">
        <i class="fas fa-money-check me-1"></i>
        <span class="d-none d-sm-inline text-uppercase">Harga Perkiraan Sendiri (HPS)</span>
        <i class="mdi {{ $edit->hps_field == "0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li> --}}
<li class="nav-item" data-target-form="#otherForm">
    <a href="{{ route('admin.undangan.edit', $edit->id) }}" class="nav-link rounded-0 pt-2 pb-2 {{ $tab == "undangan" ? "active" : "" }}">
        <i class="mdi mdi-checkbox-marked-circle-outline me-1"></i>
        <span class="d-none d-sm-inline text-uppercase">UNDANGAN</span>
        <i class="mdi {{ $edit->undangan_field == "0" ? "mdi-close-thick text-danger" : "mdi-check-bold text-success" }}"></i>
    </a>
</li>