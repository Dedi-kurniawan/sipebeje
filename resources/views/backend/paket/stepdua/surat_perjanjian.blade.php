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
                    <p class="mb-3">{{ $paket->nama }}</p>
                    <div id="rootwizard">
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            @include('backend.paket.stepdua._tab')
                        </ul>
                        <div class="tab-content mb-0 b-0 pt-0">
                            <div class="tab-pane {{ $tab == "surat-perjanjian" ? "active" : "" }}" id="first">
                                <form id="form_validate" method="POST" action="{{ route('admin.surat-perjanjian.update', $paket->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-1 fw-bold text-center">
                                                SURAT PERJANJIAN
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('nomor') ? 'is-invalid' : '' }}" autocomplete="off" name="nomor" value="{{ old('nomor', $paket->suratPerjanjian->nomor) }}" id="nomor" placeholder="Nomor..." title="kolom nomor di larang kosong" required/>
                                                {!! $errors->first('nomor', '<label id="nomor-error" class="error invalid-feedback" for="nomor">:message</label>')!!}
                                            </div>
                                            <input type="hidden" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal" readonly value="{{ old('tanggal', empty($paket->suratPerjanjian->tanggal) ? $paket->evaluasiPenawaran->tanggal : $paket->suratPerjanjian->tanggal) }}"  id="tanggal" title="kolom tanggal di larang kosong" placeholder="Tanggal..." required/>
                                            {{-- <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal" readonly value="{{ old('tanggal', empty($paket->suratPerjanjian->tanggal) ? $paket->evaluasiPenawaran->tanggal : $paket->suratPerjanjian->tanggal) }}"  id="tanggal" title="kolom tanggal di larang kosong" placeholder="Tanggal..." required/>
                                                {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                                            </div> --}}
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Bertempat di:<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('tempat') ? 'is-invalid' : '' }}" name="tempat" id="tempat" cols="30" rows="3" title="kolom tempat di larang kosong" placeholder="Bertempat..." required>{{ old('tempat', $paket->suratPerjanjian->tempat) }}</textarea>
                                                {!! $errors->first('tempat', '<label id="tempat-error" class="error invalid-feedback" for="tempat">:message</label>')!!}
                                            </div>
                                            <div class="mb-1 fw-bold text-center">
                                                Pasal 1
                                            </div>
                                            <div class="mb-2 text-center">
                                                RUANG LINGKUP PEKERJAAN
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Ruang lingkup pekerjaan dalam perjanjian ini adalah:<span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ $errors->has('ruang_lingkap') ? 'is-invalid' : '' }}" name="ruang_lingkap" id="ruang_lingkap" cols="30" rows="4" title="kolom ruang lingkUp di larang kosong" placeholder="Ruang lingkap..." required>{{ old('ruang_lingkap', $paket->suratPerjanjian->ruang_lingkap) }}</textarea>
                                                {!! $errors->first('ruang_lingkap', '<label id="ruang_lingkap-error" class="error invalid-feedback" for="ruang_lingkap">:message</label>')!!}
                                            </div>
                                            <div class="mb-1 fw-bold text-center">
                                                Pasal 2
                                            </div>
                                            <div class="mb-2 text-center">
                                                NILAI PEKERJAAN
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Nilai pekerjaan yang disepakati:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('harga_final') ? 'is-invalid' : '' }}" readonly autocomplete="off" name="harga_final" value="{{ old('harga_final', $paket->negoHarga->harga_final) }}" id="harga_final" title="kolom nilai pekerjaan yang disepakati di larang kosong" placeholder="nilai pekerjaan yang disepakati..." required />
                                                    {!! $errors->first('harga_final', '<label id="harga_final-error" class="error invalid-feedback" for="harga_final">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Nilai pekerjaan yang disepakati (Terbilang):<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control {{ $errors->has('harga_final_terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="harga_final_terbilang" value="{{ old('harga_final_terbilang', $paket->suratPerjanjian->harga_final_terbilang) }}" id="harga_final_terbilang" title="kolom nilai pekerjaan yang disepakati terbilang di larang kosong" placeholder="Nilai pekerjaan yang disepakati..." required />
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('harga_final_terbilang', '<label id="harga_final_terbilang-error" class="error invalid-feedback" for="harga_final_terbilang">:message</label>')!!}
                                                </div>
                                                <small class="text-info">Perbaiki secara manual jika terjadi kesalahan</small>
                                            </div>
                                            <div class="mb-1 fw-bold text-center">
                                                Pasal 3
                                            </div>
                                            <div class="mb-2 text-center">
                                                HAK DAN KEWAJIBAN
                                            </div>
                                            <div class="mb-1 fw-bold text-center">
                                                Pasal 4
                                            </div>
                                            <div class="mb-2 text-center">
                                                JANGKA WAKTU PELAKSANAAN PEKERJAAN
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Jangka waktu untuk menyelesaikan pekerjaan:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control {{ $errors->has('jangka_waktu') ? 'is-invalid' : '' }}" autocomplete="off" name="jangka_waktu" value="{{ old('jangka_waktu', $paket->suratPerjanjian->jangka_waktu) }}" id="jangka_waktu" title="kolom jangka waktu di larang kosong" placeholder="Jangka waktu..." required />
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light">Hari</button>
                                                    {!! $errors->first('jangka_waktu', '<label id="jangka_waktu-error" class="error invalid-feedback" for="jangka_waktu">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Hari kerja mulai tanggal :<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('mulai_jangka_waktu') ? 'is-invalid' : '' }}" autocomplete="off" name="mulai_jangka_waktu" value="{{ old('mulai_jangka_waktu', $paket->suratPerjanjian->mulai_jangka_waktu) }}"  id="mulai_jangka_waktu" title="kolom hari kerja mulai tanggal di larang kosong" required/>
                                                {!! $errors->first('mulai_jangka_waktu', '<label id="mulai_jangka_waktu-error" class="error invalid-feedback" for="mulai_jangka_waktu">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Hari kerja selesai tanggal:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('selesai_jangka_waktu') ? 'is-invalid' : '' }}" autocomplete="off" name="selesai_jangka_waktu" value="{{ old('selesai_jangka_waktu', $paket->suratPerjanjian->selesai_jangka_waktu) }}"  id="selesai_jangka_waktu" title="kolom hari kerja selesai tanggal di larang kosong" required/>
                                                {!! $errors->first('selesai_jangka_waktu', '<label id="selesai_jangka_waktu-error" class="error invalid-feedback" for="selesai_jangka_waktu">:message</label>')!!}
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Pekerjaan harus selesai dan diserahkan pada tanggal:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('diserahkan_jangka_waktu') ? 'is-invalid' : '' }}" autocomplete="off" name="diserahkan_jangka_waktu" value="{{ old('diserahkan_jangka_waktu', $paket->suratPerjanjian->diserahkan_jangka_waktu) }}"  id="diserahkan_jangka_waktu" title="kolom harus selesai tanggal di larang kosong" required/>
                                                {!! $errors->first('diserahkan_jangka_waktu', '<label id="diserahkan_jangka_waktu-error" class="error invalid-feedback" for="diserahkan_jangka_waktu">:message</label>')!!}
                                            </div>
                                            <div class="mb-1 fw-bold text-center">
                                                Pasal 5
                                            </div>
                                            <div class="mb-2 text-center">
                                                FORCE MAJEURE
                                            </div>
                                            <div class="mb-1 fw-bold text-center">
                                                Pasal 6
                                            </div>
                                            <div class="mb-2 text-center">
                                                SANKSI
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Membayar denda sebesar %:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="number" class="form-control {{ $errors->has('persen_denda') ? 'is-invalid' : '' }}" readonly value="1.5" autocomplete="off" name="persen_denda" value="{{ old('persen_denda', $paket->suratPerjanjian->persen_denda) }}"  id="persen_denda" title="kolom denda % di larang kosong" placeholder="Denda..." required/>
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light">%</button>
                                                    {!! $errors->first('persen_denda', '<label id="persen_denda-error" class="error invalid-feedback" for="persen_denda">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-2">
                                                <label for="example-input-normal" class="form-label">Nominal sebesar:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('nominal_denda') ? 'is-invalid' : '' }}" readonly autocomplete="off" name="nominal_denda" value="{{ old('nominal_denda', $paket->suratPerjanjian->nominal_denda) }}" id="nominal_denda" title="kolom nominal sebesar di larang kosong" placeholder="nominal sebesar..." required />
                                                    {!! $errors->first('nominal_denda', '<label id="nominal_denda-error" class="error invalid-feedback" for="nominal_denda">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nominal sebesar (Terbilang):<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" readonly class="form-control {{ $errors->has('nominal_denda_terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="nominal_denda_terbilang" value="{{ old('nominal_denda_terbilang', $paket->suratPerjanjian->nominal_denda_terbilang) }}" id="nominal_denda_terbilang" title="kolom nominal sebesar terbilang di larang kosong" placeholder="Nominal sebesar Terbilang..." required />
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="nominal_denda_terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('nominal_denda_terbilang', '<label id="nominal_denda_terbilang-error" class="error invalid-feedback" for="nominal_denda_terbilang">:message</label>')!!}
                                                </div>
                                                <small class="text-info">Perbaiki secara manual jika terjadi kesalahan</small>
                                            </div>
                                            <div class="mb-2">
                                                <a href="{{ route('admin.nego-harga.edit', $paket->id) }}" class="btn btn-success width-md waves-effect waves-light float-start">
                                                    BERITA ACARA NEGO HARGA <i class="fe-arrow-right"></i>
                                                </a>
                                                <button class="btn btn-primary width-md waves-effect waves-light float-end">
                                                    <i class="fe-save"></i> SELESAI PAKET
                                                </button>
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
<script src="{{ asset('backend/js/mask/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('template/barangjasa/admin/surat-perjanjian.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
