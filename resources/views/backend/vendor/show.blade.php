@extends('layouts.backend.master')
@section('title', $bread['first'])
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
        <div class="col-12 col-lg-12">
            <div class="card d-block">
                <div class="card-body">
                    <h3 class="mt-0 font-20">
                        {{ $show->nama_perusahaan }}
                    </h3>
                    <div class="badge bg-secondary text-light mb-3">{{ $show->npwp }}</div>
                    <h5>Deskripsi Usaha:</h5>
                    <p class="text-muted mb-2">
                        {{ $show->deskripsi }}
                    </p>
                    <h5>Alamat:</h5>
                    <p class="text-muted mb-2">
                        {{ $show->alamat }}
                    </p>
                    <p class="text-muted">Kecamatan : {{ $show->kecamatan->nama }} <br> Desa : {{ $show->desa->nama }}</p>

                    <div class="mb-4">
                        <h5>Kontak</h5>
                        <div class="text-uppercase">
                            {{-- <a href="mailto:{{ $show->email_perusahaan }}" class="btn btn-sm btn-soft-primary me-1"><i class="fa fa-envelope"></i> {{ $show->email_perusahaan }}</a> --}}
                            <a href="tel:{{ $show->telepon }}" class="btn btn-sm btn-soft-primary me-1"><i class="fa fa-phone"></i> {{ $show->telepon }}</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-4">
                                <h5>E-mail Penanggung Jawab</h5>
                                <p>{{ $show->user->email }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('layouts.frontend.partials.notif')
@endpush

