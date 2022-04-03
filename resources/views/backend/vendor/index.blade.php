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
                <form class="d-flex flex-wrap align-items-center">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="inputPassword2" class="visually-hidden">Search</label>
                                <div class="me-3">
                                    <label for="status-select" class="me-2">Nama</label>
                                    <input type="search" class="form-control my-1 my-md-0" id="nama_filter" placeholder="Nama...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="me-sm-3">
                                    <label for="status-select" class="me-2">Kecamatan</label>
                                    <select class="form-select my-1 my-md-0 select_filter" id="kecamatan_filter">
                                        <option value="">SEMUA KECAMATAN</option>
                                        @foreach ($kecamatan as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="me-sm-3">
                                    <label for="status-select" class="me-2">Desa</label>
                                    <select class="form-select my-1 my-md-0 select_filter" id="desa_filter">
                                        <option value="">SEMUA DESA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <label for=""></label>
                                <div class="text-md-start">
                                    <button type="button" class="btn btn-danger waves-effect waves-light" id="button_filter"><i class="fa fa-search me-1"></i> Cari</button>
                                </div>
                            </div>
                        </div> 
                    </div>
                </form>
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($akses['role'] == "admin" || $akses['role'] == "kabupaten")
                        <a href="{{ route('admin.vendor.create') }}" class="btn btn-sm btn-blue waves-effect waves-light float-end">
                            <i class="mdi mdi-plus-circle"></i> Data Baru
                        </a>
                    @endif
                    <h4 class="header-title">Menampilkan Data {{ $bread['second'] }}</h4>
                    <p class="text-muted font-13 mb-4">
                        Total : <span id="total_data"></span> {{ $bread['second'] }}</span>
                    </p>
                    <table id="datatable" class="table dt-responsive nowrap w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DESA</th>
                                <th>NAMA</th>
                                <th>NPWP</th>
                                <th>TELEPON</th>
                                <th>ALAMAT</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/vendor.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
