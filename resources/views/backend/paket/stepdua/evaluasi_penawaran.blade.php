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

                    <h4 class="header-title text-uppercase"> BERITA ACARA EVALUASI HARGA </h4>
                    <p class="mb-3">{{ $paket->nama }}</p>

                    <div id="rootwizard">
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            @include('backend.paket.stepdua._tab')
                        </ul>
                        <div class="tab-content mb-0 b-0 pt-0">
                            <div class="tab-pane {{ $tab == "evaluasi-penawaran" ? "active" : "" }}" id="first">
                                <form id="form_validate" method="POST" action="{{ route('admin.evaluasi-penawaran.update', $paket->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('nomor') ? 'is-invalid' : '' }}" maxlength="100" autocomplete="off" name="nomor" value="{{ old('nomor', $paket->evaluasiPenawaran->nomor) }}"  id="nomor" title="kolom nomor di larang kosong" placeholder="Nomor..." required/>
                                                {!! $errors->first('nomor', '<label id="nomor-error" class="error invalid-feedback" for="nomor">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Kegiatan:<span class="text-danger">*</span></label>
                                                <textarea name="kegiatan" class="form-control {{ $errors->has('kegiatan') ? 'is-invalid' : '' }}" cols="30" rows="3" placeholder="Kegiatan..." required>{{ $paket->evaluasiPenawaran->kegiatan == NULL ? $paket->nama : old('kegiatan', $paket->evaluasiPenawaran->kegiatan) }}</textarea>
                                                {!! $errors->first('kegiatan', '<label id="kegiatan-error" class="error invalid-feedback" for="kegiatan">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" maxlength="100" autocomplete="off" name="tanggal" value="{{ old('tanggal', $paket->evaluasiPenawaran->tanggal) }}"  id="tanggal" title="kolom tanggal di larang kosong" placeholder="Nomor..." required/>
                                                {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Jam:<span class="text-danger">*</span></label>
                                                <input type="time" class="form-control {{ $errors->has('jam') ? 'is-invalid' : '' }}" autocomplete="off" name="jam" value="{{ old('jam', $paket->evaluasiPenawaran->jam) }}"  id="jam" title="kolom jam di larang kosong" required/>
                                                {!! $errors->first('jam', '<label id="jam-error" class="error invalid-feedback" for="jam">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">SK Kepala Desa Nomor:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('nomor_sk') ? 'is-invalid' : '' }}" maxlength="100" autocomplete="off" name="nomor_sk" value="{{ old('nomor_sk', $paket->evaluasiPenawaran->nomor_sk) }}"  id="nomor_sk" title="kolom nomor_sk di larang kosong" placeholder="Nomor..." required/>
                                                {!! $errors->first('nomor_sk', '<label id="nomor_sk-error" class="error invalid-feedback" for="nomor_sk">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Tahun Anggaran<span class="text-danger">*</span></label>
                                                <select name="tahun_anggaran" id="tahun_anggaran" class="form-control selectFormClass {{ $errors->has('tahun_anggaran') ? 'is-invalid' : '' }}" required>
                                                    <option value="">TAHUN</option>
                                                    @for ($i = 2019; $i < date('Y')+5; $i++)
                                                        <option value="{{ $i }}" {{ $paket->evaluasiPenawaran->tahun_anggaran == $i ? "selected" : "" }}>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                                {!! $errors->first('tahun_anggaran', '<label id="tahun_anggaran-error" class="error invalid-feedback" for="tahun_anggaran">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-info width-md waves-effect waves-light">
                                                   <i class="fa fa-save"></i> SIMPAN
                                                </button>
                                                <a href="{{ route('admin.hasil-evaluasi-penawaran.edit', $paket->id) }}" class="btn btn-primary width-md waves-effect waves-light float-end">
                                                    HASIL EVALUASI PENAWARAN <i class="fe-arrow-right"></i>
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
@endsection
@push('scripts')
@include('layouts.frontend.partials.notif')
@endpush
