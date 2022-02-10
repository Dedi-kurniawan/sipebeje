@extends('layouts.backend.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header bg-primary">SIPEBEJE</div>
                <div class="card-body">
                    <h4 class="card-title text-white">Sistem Informasi Pengadaan Barang & Jasa Desa</h4>
                    <p class="card-text">Pengadaan Barang & Jasa secara Elektronik melalui sistem Informasi yang di akses secara daring oleh Penyedia, Pemerintah Desa & Dinas PMD</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<link href="{{ asset('backend/libs/flatpickr/flatpickr.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('backend/libs/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ asset('backend/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('backend/libs/selectize/js/standalone/selectize.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/dashboard-1.init.js') }}"></script>
@endpush
