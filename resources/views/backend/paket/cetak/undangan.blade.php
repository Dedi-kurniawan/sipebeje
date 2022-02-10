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
                    <h4 class="header-titl text-uppercase"> CETAK UNDANGAN VENDOR</h4>
                    <p class="mb-3">{{ $paket->nama }}</p>

                    <p class="text-muted font-13 mb-4">
                        Total : <span id="total_data_vendor"></span> {{ $bread['second'] }}</span>
                    </p>
                    <input type="hidden" id="paket_id" value="{{ $paket->id }}">
                    <table id="dt_undangan" class="table table-bordered table-sm nowrap w-100">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>DESA</th>
                                <th>PERUSAHAAN</th>
                                <th>STATUS</th>
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
<script src="{{ asset('template/barangjasa/admin/cetak-undangan.js') }}?{{ date('ymdshi') }}"></script>
@endpush
