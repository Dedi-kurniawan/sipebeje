<div class="left-side-menu">

  <div class="h-100" data-simplebar>
      <div id="sidebar-menu">
          @if (Auth::user()->role == 'admin' || Auth::user()->role == 'kabupaten')
            @include('layouts.backend.partials.menu.admin')
          @elseif(Auth::user()->role == 'desa')
            @include('layouts.backend.partials.menu.desa')
          @elseif(Auth::user()->role == 'vendor')
            @include('layouts.backend.partials.menu.vendor')
          @endif
      </div>
      <div class="clearfix"></div>
  </div>
</div>