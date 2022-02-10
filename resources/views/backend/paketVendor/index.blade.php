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
                    <div class="row justify-content-between">
                        <div class="col-auto">
                            <form class="d-flex flex-wrap align-items-center">
                                <div class="me-3">
                                    <input type="search" class="form-control my-1 my-lg-0" id="search_filter" placeholder="Search...">
                                </div>
                                <label for="status-select" class="me-2">Status</label>
                                <div class="me-sm-3">
                                    <select class="form-select my-1 my-lg-0" id="status_filter">
                                        <option value="">Semua</option>
                                        <option value="selesai">Selesai</option>
                                        <option value="proses">Proses</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="col-auto">
                            <div class="text-lg-end my-1 my-lg-0">
                                <button class="btn btn-blue waves-effect waves-light" id="button_filter"><i class="mdi mdi-account-search"></i> Cari</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title">Menampilkan Data {{ $bread['second'] }}</h4>
                    <p class="text-muted font-13 mb-4">
                        Total : <span id="total_data"></span> {{ $bread['second'] }}</span>
                    </p>
                    <table id="dt_paket" class="table dt-responsive w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DESA</th>
                                <th>NAMA PAKET</th>
                                <th>HPS</th>
                                <th>PENANGGUNG JAWAB</th>
                                <th>PEMENANG</th>
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
<script src="{{ asset('template/barangjasa/admin/paket-vendor.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
