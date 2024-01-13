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
                <div class="card-header">
                    <h4 class="header-title">LAPORAN PENGADAAN BARANG JASA PER DESA</h4>
                </div>
                <div class="card-body">
                    <form id="form_validate" method="GET" action="{{ route('admin.laporan.cetak') }}">
                        @method('GET')
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="example-input-normal" class="form-label">Dari:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" autocomplete="off" name="dari" value="{{ old('dari') }}"  id="dari" title="kolom dari di larang kosong" placeholder="Dari..." required/>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="example-input-normal" class="form-label">Sampai:<span class="text-danger">*</span></label>
                                <input type="date" class="form-control" autocomplete="off" name="sampai" value="{{ old('sampai') }}"  id="sampai" title="kolom sampai di larang kosong" placeholder="Sampai..." required/>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="example-input-normal" class="form-label">Desa</label>
                                <select name="desa" class="form-control selectFormClass" id="desa">
                                    <option value="">Semua Desa</option>
                                    @foreach ($desa as $x)
                                        <option value="{{ $x->id }}">{{ $x->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="example-input-normal" class="form-label">&nbsp;</label> <br>
                                <button type="submit" class="btn btn-blue waves-effect waves-light">
                                    <i class="mdi mdi-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="header-title">LAPORAN DAFTAR PENYEDIA YANG DI TERDAFTAR DI SIPEBEJE</h4>
                </div>
                <div class="card-body">
                    <form id="form_validate" method="GET" action="{{ route('admin.laporan.penyedia') }}">
                        @method('GET')
                        <div class="row">
                            <div class="mb-3 col-3">
                                <label for="example-input-normal" class="form-label">Desa</label>
                                <select name="desa" class="form-control selectFormClass" id="desa">
                                    <option value="">Semua Desa</option>
                                    @foreach ($desa as $x)
                                        <option value="{{ $x->id }}">{{ $x->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3 col-3">
                                <label for="example-input-normal" class="form-label">&nbsp;</label> <br>
                                <button type="submit" class="btn btn-blue waves-effect waves-light">
                                    <i class="mdi mdi-download"></i> Download
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('layouts.frontend.partials.notif')
@endpush