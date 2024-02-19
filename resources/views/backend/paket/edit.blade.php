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
                    <h4 class="header-titl text-uppercase"> FORMULIR {{ $bread['second'] }}</h4>
                    <p class="mb-3">{{ $edit->nama }}</p>
                    <div id="rootwizard">
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            @include('backend.paket._tab')
                        </ul>
                        <div class="tab-content mb-0 b-0 pt-0">
                            <div class="tab-pane {{ $tab == "paket" ? "active" : "" }}" id="first">
                                <form id="form_validate" method="POST" action="{{ route('admin.paket.update', $edit->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nama Paket:<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" name="nama" id="nama" cols="30" rows="3" title="kolom nama di larang kosong" placeholder="Paket..." required>{{ old('nama', $edit->nama) }}</textarea>
                                                {!! $errors->first('nama', '<label id="nama-error" class="error invalid-feedback" for="nama">:message</label>')!!}
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-6">
                                                    <label for="example-input-normal" class="form-label">Jenis:<span class="text-danger">*</span></label>
                                                    <select name="jenis" class="form-control selectFormClass {{ $errors->has('jenis') ? 'is-invalid' : '' }}" id="jenis" required>
                                                        <option value="">Pilih Jenis</option>
                                                        <option value="Metode Penawaran" {{ old('jenis', $edit->jenis) == "Metode Penawaran" ? "selected" : "" }}>Metode Penawaran</option>
                                                        <option value="Metode Lelang" {{ old('jenis', $edit->jenis) == "Metode Lelang" ? "selected" : "" }}>Metode Lelang</option>
                                                    </select>
                                                    {!! $errors->first('jenis', '<label id="jenis-error" class="error invalid-feedback" for="jenis">:message</label>')!!}
                                                </div>
                                                <div class="col-6">
                                                    <label for="example-input-normal" class="form-label">Penanggung Jawab:<span class="text-danger">*</span></label>
                                                    <select name="aparatur_id" class="form-control selectFormClass {{ $errors->has('aparatur_id') ? 'is-invalid' : '' }}" id="aparatur_id" required title="Kolom penanggung jawab di larang kosong">
                                                        <option value="">Pilih Penanggung Jawab</option>
                                                        @foreach ($aparatur as $a)
                                                            <option value="{{ $a->id }}" {{ old('aparatur_id', $edit->aparatur_id) == $a->id ? "selected" : "" }}>{{ $a->nama }}-{{ $a->jabatan }}</option>
                                                        @endforeach
                                                    </select>
                                                    {!! $errors->first('aparatur_id', '<label id="aparatur_id-error" class="error invalid-feedback" for="aparatur_id">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">HPS:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('hps') ? 'is-invalid' : '' }}" autocomplete="off" name="hps" value="{{ old('hps', $edit->hps) }}" id="hps" title="kolom hps di larang kosong" placeholder="HPS..." readonly/>
                                                    {!! $errors->first('hps', '<label id="hps-error" class="error invalid-feedback" for="hps">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">HPS (Terbilang):<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control {{ $errors->has('terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="terbilang" value="{{ old('terbilang', $edit->terbilang) }}" id="terbilang" title="kolom terbilang di larang kosong" placeholder="HPS Terbilang..." readonly/>
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('terbilang', '<label id="terbilang-error" class="error invalid-feedback" for="terbilang">:message</label>')!!}
                                                </div>
                                                <small class="text-info">Perbaiki secara manual jika terjadi kesalahan</small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Akhir Pendaftaran:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('tanggal_selesai') ? 'is-invalid' : '' }}" maxlength="100" autocomplete="off" name="tanggal_selesai" value="{{ old('tanggal_selesai', $edit->tanggal_selesai) }}" id="tanggal_selesai" title="kolom tanggal selesai di larang kosong" placeholder="Akhir Pendaftaran..." required />
                                                {!! $errors->first('tanggal_selesai', '<label id="tanggal_selesai-error" class="error invalid-feedback" for="tanggal_selesai">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Deskripsi:<span class="text-danger">*</span></label>
                                                <input type="hidden" name="keterangan" id="keterangan" value="{{ old('keterangan', $edit->keterangan) }}">
                                                <div id="editor" style="min-height: 160px;">{!! old('keterangan', $edit->keterangan) !!}</div>
                                                {!! $errors->first('keterangan', '<label id="keterangan-error" class="error invalid-feedback" for="keterangan">:message</label>')!!}
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input type="hidden" id="paket_id_value" value="{{ $edit->id }}">
                                                    <button type="button" class="btn btn-success btn-md float-end" onclick="createData()">
                                                        <i class="fe-plus"></i> TAMBAH HPS
                                                    </button>
                                                </div>
                                                <div class="col-12">
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
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-info width-md waves-effect waves-light">
                                                    <i class="fa fa-save"></i> SIMPAN
                                                </button>
                                                <a href="{{ route('admin.akk.edit', $edit->id) }}" class="btn btn-primary width-md waves-effect waves-light float-end">
                                                    KERANGKA ACUAN KERJA (KAK) <i class="fe-arrow-right"></i>
                                                </a>
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
@include('backend.paket._hps')
@endsection
@push('css')
<link href="{{ asset('backend/libs/quill/quill.core.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/quill/quill.bubble.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('backend/libs/quill/quill.snow.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('backend/libs/quill/quill.min.js') }}"></script>
<script src="{{ asset('backend/js/pages/form-quilljs.init.js') }}"></script>
<script src="{{ asset('backend/js/mask/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('template/barangjasa/admin/hps.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
