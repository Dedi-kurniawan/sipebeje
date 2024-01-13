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
                            <div class="tab-pane {{ $tab == "akk" ? "active" : "" }}" id="first">
                                <form id="form_validate" method="POST" action="{{ route('admin.akk.update', $edit->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">KEGIATAN<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('kegiatan') ? 'is-invalid' : '' }}" name="kegiatan" id="kegiatan" cols="30" rows="3" title="kolom kegiatan di larang kosong" required>{{ old('kegiatan', $edit->akk->kegiatan) == NULL ? $edit->nama : old('kegiatan', $edit->akk->kegiatan) }}</textarea>
                                                {!! $errors->first('kegiatan', '<label id="kegiatan-error" class="error invalid-feedback" for="kegiatan">:message</label>')!!}
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-6">
                                                    <label for="example-input-normal" class="form-label">DUSUN<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control {{ $errors->has('dusun') ? 'is-invalid' : '' }}" autocomplete="off" name="dusun" value="{{ old('dusun', $edit->akk->dusun) }}"  id="dusun" title="kolom dusun di larang kosong" placeholder="DUSUN" required/>
                                                    {!! $errors->first('dusun', '<label id="dusun-error" class="error invalid-feedback" for="dusun">:message</label>')!!}  
                                                </div>
                                                <div class="col-6">
                                                    <label for="example-input-normal" class="form-label">RT<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control {{ $errors->has('rt') ? 'is-invalid' : '' }}" autocomplete="off" name="rt" value="{{ old('rt', $edit->akk->rt) }}"  id="rt" title="kolom rt di larang kosong" placeholder="RT" required/>
                                                    {!! $errors->first('rt', '<label id="rt-error" class="error invalid-feedback" for="rt">:message</label>')!!}  
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">I.	LATAR BELAKANG<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('latar_belakang') ? 'is-invalid' : '' }}" name="latar_belakang" id="latar_belakang" cols="30" rows="5" title="kolom latar belakang di larang kosong" placeholder="DIJELASKAN LATAR BELAKANG KEGIATAN DI SANDINGKAN DENGAN RENSTRA, RKP DESA DAN USULAN MUSYAWARAH DESA SERTA OUTPUT YANG DIHARAPKAN SERTA DAMPAK POSITIF YANG DIHARAPKAN" required>{{ old('latar_belakang', $edit->akk->latar_belakang) == NULL ? "" : old('latar_belakang', $edit->akk->latar_belakang) }}</textarea>
                                                {!! $errors->first('latar_belakang', '<label id="latar_belakang-error" class="error invalid-feedback" for="latar_belakang">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">II. MAKSUD DAN TUJUAN<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">MAKSUD<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('maksud') ? 'is-invalid' : '' }}" name="maksud" id="maksud" cols="30" rows="3" title="kolom maksud di larang kosong" placeholder="MENJELASKAN KEGUNAAN BARANG/JASA YANG AKAN DIREALISASIKAN" required>{{ old('maksud', $edit->akk->maksud) == NULL ? "" : old('maksud', $edit->akk->maksud) }}</textarea>
                                                {!! $errors->first('maksud', '<label id="maksud-error" class="error invalid-feedback" for="maksud">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">TUJUAN<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('tujuan') ? 'is-invalid' : '' }}" name="tujuan" id="tujuan" cols="30" rows="3" title="kolom tujuan di larang kosong" placeholder="MENJELASKAN TUJUAN/HASIL SECARA UMUM" required>{{ old('tujuan', $edit->akk->tujuan) == NULL ? "" : old('tujuan', $edit->akk->tujuan) }}</textarea>
                                                {!! $errors->first('tujuan', '<label id="tujuan-error" class="error invalid-feedback" for="tujuan">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">III. HASIL YANG DIHARAPKAN<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('hasil') ? 'is-invalid' : '' }}" name="hasil" id="hasil" cols="30" rows="3" title="kolom hasil di larang kosong" placeholder="MENJELASKAN HASIL SECARA DETAIL DARI PENGADAAN YANG AKAN DIADAKAN" required>{{ old('hasil', $edit->akk->hasil) == NULL ? "" : old('hasil', $edit->akk->hasil) }}</textarea>
                                                {!! $errors->first('hasil', '<label id="hasil-error" class="error invalid-feedback" for="hasil">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">IV. LOKASI KEGIATAN<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('lokasi_kegiatan') ? 'is-invalid' : '' }}" name="lokasi_kegiatan" id="lokasi_kegiatan" cols="30" rows="3" title="kolom lokasi kegiatan di larang kosong" placeholder="LOKASI KEGIATAN DUSUN……(PENAMAAN LOKASI YG SERING DISEBUT OLEH MASYARAKAT)" required>{{ old('lokasi_kegiatan', $edit->akk->lokasi_kegiatan) == NULL ? "" : old('lokasi_kegiatan', $edit->akk->lokasi_kegiatan) }}</textarea>
                                                {!! $errors->first('lokasi_kegiatan', '<label id="lokasi_kegiatan-error" class="error invalid-feedback" for="lokasi_kegiatan">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">V.	DASAR PENGANGGARAN<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-4 col-lg-4 mb-2 col-12">
                                                    <label for="example-input-normal" class="form-label">PERDES APBDES<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control {{ $errors->has('dasar_penganggaran') ? 'is-invalid' : '' }}" autocomplete="off" name="dasar_penganggaran" value="{{ old('dasar_penganggaran', $edit->akk->dasar_penganggaran) }}"  id="dasar_penganggaran" title="kolom dasar penganggaran di larang kosong" placeholder="PERDESA... PBDES..." required/>
                                                    {!! $errors->first('dasar_penganggaran', '<label id="dasar_penganggaran-error" class="error invalid-feedback" for="dasar_penganggaran">:message</label>')!!}  
                                                </div>
                                                <div class="col-md-4 col-lg-4 mb-2 col-12">
                                                    <label for="example-input-normal" class="form-label">NO<span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control {{ $errors->has('dp_no') ? 'is-invalid' : '' }}" autocomplete="off" name="dp_no" value="{{ old('dp_no', $edit->akk->dp_no) }}"  id="dp_no" title="kolom dp_no di larang kosong" placeholder="NO" required/>
                                                    {!! $errors->first('dp_no', '<label id="dp_no-error" class="error invalid-feedback" for="dp_no">:message</label>')!!}  
                                                </div>
                                                <div class="col-md-4 col-lg-4 mb-2 col-12">
                                                    <label for="example-input-normal" class="form-label">TANGGAL<span class="text-danger">*</span></label>
                                                    <input type="date" class="form-control {{ $errors->has('dp_tgl') ? 'is-invalid' : '' }}" autocomplete="off" name="dp_tgl" value="{{ old('dp_tgl', $edit->akk->dp_tgl) }}"  id="dp_tgl" title="kolom tanggal di larang kosong" placeholder="TANGGAL" required/>
                                                    {!! $errors->first('dp_tgl', '<label id="dp_tgl-error" class="error invalid-feedback" for="dp_tgl">:message</label>')!!}  
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3 col-lg-3 mb-2 col-12">
                                                    <label for="example-input-normal" class="form-label">BIDANG<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control {{ $errors->has('dp_bidang') ? 'is-invalid' : '' }}" autocomplete="off" name="dp_bidang" value="{{ old('dp_bidang', $edit->akk->dp_bidang) == NULL ? $edit->aparatur->jabatan : old('dp_bidang', $edit->akk->dp_bidang) }}"  id="dp_bidang" title="kolom bidang di larang kosong" placeholder="BIDANG" required/>
                                                    {!! $errors->first('dp_bidang', '<label id="dp_bidang-error" class="error invalid-feedback" for="dp_bidang">:message</label>')!!}  
                                                </div>
                                                <div class="col-md-3 col-lg-3 mb-2 col-12">
                                                    <label for="example-input-normal" class="form-label">SUB BIDANG<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control {{ $errors->has('dp_subbidang') ? 'is-invalid' : '' }}" autocomplete="off" name="dp_subbidang" value="{{ old('dp_subbidang', $edit->akk->dp_subbidang) }}"  id="dp_subbidang" title="kolom subbidang di larang kosong" placeholder="SUB BIDANG" required/>
                                                    {!! $errors->first('dp_subbidang', '<label id="dp_subbidang-error" class="error invalid-feedback" for="dp_subbidang">:message</label>')!!}  
                                                </div> 
                                                <div class="col-md-6 col-lg-6 mb-2 col-12">
                                                    <label for="example-input-normal" class="form-label">KEGIATAN<span class="text-danger">*</span></label>
                                                    <input type="text" class="form-control {{ $errors->has('dp_kegiatan') ? 'is-invalid' : '' }}" maxlength="255" autocomplete="off" name="dp_kegiatan" value="{{ old('dp_kegiatan', $edit->akk->dp_kegiatan) == NULL ? $edit->nama : $edit->akk->dp_kegiatan }}"  id="dp_kegiatan" title="kolom kegiatan di larang kosong" placeholder="KEGIATAN" required/>
                                                    {!! $errors->first('dp_kegiatan', '<label id="dp_kegiatan-error" class="error invalid-feedback" for="dp_kegiatan">:message</label>')!!}  
                                                </div>                                               
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">VI. JANGKA WAKTU PELAKSANAAN<span class="text-danger">*</span></label>
                                                <input type="number" class="form-control {{ $errors->has('waktu_pelaksanaan') ? 'is-invalid' : '' }}" autocomplete="off" name="waktu_pelaksanaan" value="{{ old('waktu_pelaksanaan', $edit->akk->waktu_pelaksanaan) }}"  id="waktu_pelaksanaan" title="kolom jangka waktu pelaksanaan di larang kosong" placeholder="HARI" required/>
                                                {!! $errors->first('waktu_pelaksanaan', '<label id="waktu_pelaksanaan-error" class="error invalid-feedback" for="waktu_pelaksanaan">:message</label>')!!}  
                                                <small class="text-primary text-uppercase">PELAKSANAAN {{ $edit->nama }} YAITU SELAMA……HARI</small>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">VII. GAMBARAN PELAKSANAAN KEGIATAN<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('gambaran_pelaksanaan') ? 'is-invalid' : '' }}" name="gambaran_pelaksanaan" id="gambaran_pelaksanaan" cols="30" rows="3" title="kolom gambar pelaksanaan kegiatan di larang kosong" placeholder="PENYEDIA WAJIB MEMBUAT JADWAL PELAKSANAAN KEGIATAN PEKERJAAN" required>{{ old('gambaran_pelaksanaan', $edit->akk->gambaran_pelaksanaan) == NULL ? "" : old('gambaran_pelaksanaan', $edit->akk->gambaran_pelaksanaan) }}</textarea>
                                                {!! $errors->first('gambaran_pelaksanaan', '<label id="gambaran_pelaksanaan-error" class="error invalid-feedback" for="gambaran_pelaksanaan">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">VIII. SPESIFIKASI TEKNIS (TERLAMPIR)<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('spesifikasi_teknis') ? 'is-invalid' : '' }}" name="spesifikasi_teknis" id="spesifikasi_teknis" cols="30" rows="3" title="kolom spesifikasi teknis di larang kosong" required>{{ old('spesifikasi_teknis', $edit->akk->spesifikasi_teknis) == NULL ? "" : old('spesifikasi_teknis', $edit->akk->spesifikasi_teknis) }}</textarea>
                                                {!! $errors->first('spesifikasi_teknis', '<label id="spesifikasi_teknis-error" class="error invalid-feedback" for="spesifikasi_teknis">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">IX. DAFTAR TENAGA KERJA DARI DESA<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('tenaga_kerja') ? 'is-invalid' : '' }}" name="tenaga_kerja" id="tenaga_kerja" cols="30" rows="3" title="kolom daftar tenaga kerja dari desa di larang kosong" required>{{ old('tenaga_kerja', $edit->akk->tenaga_kerja) == NULL ? "" : old('tenaga_kerja', $edit->akk->tenaga_kerja) }}</textarea>
                                                {!! $errors->first('tenaga_kerja', '<label id="tenaga_kerja-error" class="error invalid-feedback" for="tenaga_kerja">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">X.	METODE PENGADAAN<span class="text-danger">*</span></label>
                                                @php
                                                    $metode_pengadaan =  $edit->akk->metode_pengadaan == NULL ? $edit->jenis : $edit->akk->metode_pengadaan
                                                @endphp
                                                <select name="metode_pengadaan" class="form-control selectFormClass {{ $errors->has('metode_pengadaan') ? 'is-invalid' : '' }}" id="metode_pengadaan" required>
                                                    <option value="">PILIH METODE PENGADAAN</option>
                                                    <option value="Pengadaan Langsung" {{ old('metode_pengadaan', $metode_pengadaan) == "Pengadaan Langsung" ? "selected" : "" }}>Pengadaan Langsung</option>
                                                    <option value="Tender" {{ old('metode_pengadaan', $metode_pengadaan) == "Tender" ? "selected" : "" }}>Tender</option>
                                                </select>
                                                {!! $errors->first('metode_pengadaan', '<label id="metode_pengadaan-error" class="error invalid-feedback" for="metode_pengadaan">:message</label>')!!}
                                            </div>
                                            <div class="mb-3 mt-4">
                                                <label for="example-input-normal" class="form-label">XI. PAGU ANGGARAN<span class="text-danger">*</span></label>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">PAGU ANGGARAN</label>
                                                <textarea class="form-control {{ $errors->has('pagu_anggaran') ? 'is-invalid' : '' }}" name="pagu_anggaran" id="pagu_anggaran" cols="30" rows="3" title="kolom pagu_anggaran di larang kosong" required>{{ old('pagu_anggaran', $edit->akk->pagu_anggaran) == NULL ? $edit->nama : old('pagu_anggaran', $edit->akk->pagu_anggaran) }}</textarea>
                                                {!! $errors->first('pagu_anggaran', '<label id="pagu_anggaran-error" class="error invalid-feedback" for="pagu_anggaran">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">PAGU ANGGARAN<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('pagu_anggaran_rp') ? 'is-invalid' : '' }}" autocomplete="off" name="pagu_anggaran_rp" value="{{ old('pagu_anggaran_rp', $edit->akk->pagu_anggaran_rp) == NULL ? $edit->hps : old('pagu_anggaran_rp', $edit->akk->pagu_anggaran_rp) }}"  id="pagu_anggaran_rp" title="kolom pagu_anggaran_rp di larang kosong" placeholder="HPS" required/>
                                                    {!! $errors->first('pagu_anggaran_rp', '<label id="pagu_anggaran_rp-error" class="error invalid-feedback" for="pagu_anggaran_rp">:message</label>')!!}  
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">PAGU ANGGARAN (Terbilang)<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control {{ $errors->has('pagu_anggaran_terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="pagu_anggaran_terbilang" value="{{ old('pagu_anggaran_terbilang', $edit->akk->pagu_anggaran_terbilang) == NULL ? $edit->terbilang : old('pagu_anggaran_terbilang', $edit->akk->pagu_anggaran_terbilang) }}"  id="pagu_anggaran_terbilang" title="kolom pagu anggaran terbilang di larang kosong" placeholder="PAGU ANGGARAN Terbilang" required/>
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="pagu_anggaran_terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('pagu_anggaran_terbilang', '<label id="pagu_anggaran_terbilang-error" class="error invalid-feedback" for="pagu_anggaran_terbilang">:message</label>')!!} 
                                                </div> 
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit" class="btn btn-info width-md waves-effect waves-light">
                                                   <i class="fa fa-save"></i> SIMPAN
                                                </button>
                                                @if ($edit->akk_field == "1")
                                                    <a target="_blank" href="{{ route('admin.print-kak', $edit->id) }}" class="btn btn-warning width-md waves-effect waves-light text-white">
                                                        <i class="fa fa-download"></i> DOWNLOAD
                                                    </a>
                                                @endif
                                                <a href="{{ route('admin.undangan.edit', $edit->id) }}" class="btn btn-primary width-md waves-effect waves-light float-end">
                                                    UNDANGAN <i class="fe-arrow-right"></i>
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
@push('css')
<link href="{{ asset('backend/libs/summernote/summernote-lite.min.css') }}" rel="stylesheet" type="text/css" />
@endpush
@push('scripts')
<script src="{{ asset('backend/libs/summernote/summernote-lite.min.js') }}"></script>
<script src="{{ asset('backend/js/mask/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('template/barangjasa/admin/akk.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
