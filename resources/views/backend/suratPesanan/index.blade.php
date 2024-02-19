@extends('layouts.backend.master')
@section('title', $bread['second'])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $bread['first'] }}</a></li>
                        <li class="breadcrumb-item"><a href="{{ $bread['url'] }}">{{ $bread['second'] }}</a></li>
                        <li class="breadcrumb-item active">{{ $bread['third'] }}</li>
                    </ol>
                </div>
                <h4 class="page-title">{{ $bread['first'] }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <form class="d-flex flex-wrap align-items-center">
                            <div class="col-5">
                                <input type="search" class="form-control" id="search_filter" placeholder="Search...">
                            </div>
                            <div class="col-4">
                                <select class="form-select select_filter my-2" id="desa_filter">
                                    <option value="">Semua</option>
                                    @foreach ($desa as $x)
                                        <option value="{{ $x->id }}" {{ $x->id == $desaId ? 'selected' : '' }}>{{ $x->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3">
                                &nbsp;
                                <button type="button" class="btn btn-blue waves-effect waves-light mx-2" id="button_filter">
                                    <i class="mdi mdi-account-search"></i> Cari
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(Auth::user()->role == 'desa')
                        <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-end" id="createData" onclick="createData()">
                            <i class="mdi mdi-plus-circle"></i> Surat Pesan Baru
                        </button>
                    @endif
                    <h4 class="header-title">Menampilkan Data {{ $bread['second'] }}</h4>
                    <p class="text-muted font-13 mb-4">
                        Total : <span id="total_data"></span> {{ $bread['second'] }}</span>
                    </p>
                    <table id="datatable" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NO PESANAN</th>
                                <th>PAKET</th>
                                <th>DESA</th>
                                <th>PENYEDIA</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody class="text-uppercase"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.suratPesanan._form')
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/surat-pesanan.js') }}?{{ date('ymdshi') }}"></script>
@if($errors->any())
<script type="text/javascript">
     $(window).on('load', function() {
        $('#formModal').modal('show');
    });
</script>
@endif
@include('layouts.frontend.partials.notif')
@endpush
