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
                <h4 class="page-title text-uppercase small">{{ $bread['first'] }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-uppercase">FORMULIR HARGA PERKIRAAN KERJA (HPS)</h4>
                    <p class="mb-3">{{ $edit->nama }}</p>
                    <div id="rootwizard">
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            @include('backend.paket._tab')
                        </ul>
                        <div class="tab-content mb-0 b-0 pt-0">
                            <div class="mb-3 d-flex">
                                <button class="btn btn-success width-md waves-effect waves-light float-end" onclick="createData()">
                                     <i class="fe-plus"></i> TAMBAH HPS
                                </button>
                                <input type="hidden" value="{{ $edit->id }}" id="paket_id_value">
                            </div>
                            <div class="tab-pane {{ $tab == "hps" ? "active" : "" }}" id="first">                                
                                <div class="table-responsive">
                                    <table id="datatable" class="table nowrap w-100 mt-3">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>URAIAN</th>
                                                <th>VOLUME</th>
                                                <th>HARGA @</th>
                                                <th>SATUAN</th>
                                                <th>JUMLAH</th>
                                                <th>PAJAK</th>
                                                <th>HARGA SETELAH PAJAK</th>
                                                <th>KETERANGAN</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                    </table>
                                </div>
                                <div class="mt-3">
                                    <a href="{{ route('admin.akk.edit', $edit->id) }}" class="btn btn-info width-md waves-effect waves-light float-start">
                                        <i class="fe-arrow-left"></i> KERANGKA ACUAN KERJA (KAK)
                                    </a>
                                    <a href="{{ route('admin.undangan.edit', $edit->id) }}" class="btn btn-primary width-md waves-effect waves-light float-end">
                                         UNDANGAN <i class="fe-arrow-right"></i>
                                     </a>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.paket._hps')
@endsection
@push('scripts')
<script src="{{ asset('backend/js/mask/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('template/barangjasa/admin/hps.js') }}?{{ date('ymdshi') }}"></script>
@endpush
