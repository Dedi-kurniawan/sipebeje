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

                    <h4 class="header-title text-uppercase"> FORMULIR {{ $bread['second'] }}</h4>
                    <p class="mb-3">{{ $edit->nama }}</p>

                    <div id="rootwizard">
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            @include('backend.paket._tab')
                        </ul>

                        <div class="tab-content mb-0 b-0 pt-0">
                            <div class="tab-pane {{ $tab == "undangan" ? "active" : "" }}" id="first">
                                <form id="form_validate" method="POST" action="{{ route('admin.undangan.update', $edit->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nomor<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('nomor') ? 'is-invalid' : '' }}" maxlength="255" autocomplete="off" name="nomor" id="nomor" value="{{ old('nomor', $edit->undangan->nomor) }}" title="kolom nomor di larang kosong" placeholder="Nomor..."required />
                                                {!! $errors->first('nomor', '<label id="nomor-error"class="error invalid-feedback" for="nomor">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Perihal<span class="text-danger">*</span></label>
                                                <input type="text"class="form-control {{ $errors->has('perihal') ? 'is-invalid' : '' }}"maxlength="255" autocomplete="off" name="perihal" id="perihal"value="{{ old('perihal', $edit->undangan->perihal) == NULL ? $edit->nama : $edit->undangan->perihal }}"title="kolom perihal di larang kosong" placeholder="Perihal..."required />
                                                {!! $errors->first('perihal', '<label id="perihal-error"class="error invalid-feedback" for="perihal">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Pilih Vendor YangAkan Di Undang<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="mb-1">
                                                <div class="row"><div class="col-5">    <label for="example-input-normal" class="form-label">Desa<span class="text-danger">*</span></label>    <select class="form-control selectFormClass" id="desa_id">        @foreach ($desa as $v)        <option value="{{ $v->id }}" {{ $desa_id==$v->id ?            "selected" : "" }}>{{ $v->nama }}</option>        @endforeach    </select></div><div class="col-5">
                                                        <input type="hidden" id="undangan_id" value="{{ $edit->undangan->id }}">
                                                        <input type="hidden" id="paket_id" value="{{ $edit->id }}">
                                                        <label for="example-input-normal" class="form-label">Vendor<span class="text-danger">*</span></label>
                                                        <select class="form-control selectFormClass" id="vendor_id" name="vendor_id"></select>
                                                        <label id='vendor_id_error' class='error text-danger' for='vendor_id_error'></label>
                                                    </div>
                                                    <div class="col-2">
                                                        <label for="">Aksi</label>
                                                        <div></div>
                                                        <span id="addVendor" class="btn btn-primary mt-2">Tambah</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="table-responsive">
                                                <h5><span id="total_data_vendor"></span> total vendor</h5>
                                                <table id="dt_vendor" class="table table-bordered table-sm nowrap w-100 text-center">
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
                                            <br>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">1. Paket Pengadaan Material/Jasa<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="mb-3">
                                                <span onclick="addMaterial()" class="btn btn-primary mt-2">Tambah Material/Jasa</span>
                                            </div>
                                            <div class="table-responsive">
                                                <table id="dt_material" class="table table-bordered nowrap w-100">
                                                    <thead>
                                                        <tr>
                                                            <th>NO</th>
                                                            <th>URAIAN</th>
                                                            <th>VOLUME</th>
                                                            <th>HARGA @</th>
                                                            <th>SATUAN</th>
                                                            <th>AKSI</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nilai total:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('nilai_total') ? 'is-invalid' : '' }}" autocomplete="off" name="nilai_total" value="{{ old('nilai_total', $edit->undangan->nilai_total) }}" id="nilai_total" title="kolom nilai total di larang kosong" placeholder="Nilai total..." required />
                                                    {!! $errors->first('nilai_total', '<label id="nilai_total-error" class="error invalid-feedback" for="nilai_total">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nilai total (Terbilang):<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control {{ $errors->has('terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="terbilang" value="{{ old('terbilang', $edit->undangan->terbilang) }}" id="terbilang" title="kolom terbilang di larang kosong" placeholder="Nilai total Terbilang..." required />
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('terbilang', '<label id="terbilang-error" class="error invalid-feedback" for="terbilang">:message</label>')!!}
                                                </div>
                                                <small class="text-info">Perbaiki secara manual jika terjadi kesalahan</small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Sumber dana (APB Desa Tahun Anggaran)<span class="text-danger">*</span></label>
                                                <select name="sumber_dana" id="sumber_dana" class="form-control selectFormClass {{ $errors->has('sumber_dana') ? 'is-invalid' : '' }}" required>
                                                    <option value="">TAHUN</option>
                                                    @for ($i = 2019; $i < date('Y')+5; $i++) 
                                                        <option value="{{ $i }}" {{ $edit->undangan->sumber_dana == $i ? "selected" : "" }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                {!! $errors->first('sumber_dana', '<label id="sumber_dana-error" class="error invalid-feedback" for="sumber_dana">:message</label>')!!}
                                            </div>
                                            <hr>
                                            <div class="text-sm-end">
                                                <a href="{{ route('admin.hps.edit', $edit->id) }}" class="btn btn-primary width-md waves-effect waves-light float-start">
                                                    <i class="fe-arrow-left"></i> HARGA PERKIRAAN KERJA (HPS)
                                                </a>
                                                <button type="submit" data-toggle="tooltip" title="Undangan akan di kirim secara otomatis ke semua vendor" tabindex="0" data-plugin="tippy" data-tippy-arrow="true" data-tippy-arrowTransform="scaleX(1.5)" data-tippy-animation="fade" class="btn btn-info width-md waves-effect waves-light submitForm" name="submit" data-name="Otomatis" value="otomatis"> KIRIM UNDANGAN <i class="fab fa-telegram-plane"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.paket._material')
@endsection
@push('scripts')
<script src="{{ asset('backend/js/mask/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('backend/libs/tippy.js/tippy.all.min.js') }}"></script>
<script src="{{ asset('template/barangjasa/admin/undangan.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush