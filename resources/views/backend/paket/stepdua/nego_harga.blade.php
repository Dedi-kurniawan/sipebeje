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
                            <div class="tab-pane {{ $tab == "nego-harga" ? "active" : "" }}" id="first">
                                <form id="form_validate" method="POST" action="{{ route('admin.nego-harga.update', $paket->id) }}" class="form-horizontal">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ $errors->has('nomor') ? 'is-invalid' : '' }}" autocomplete="off" name="nomor" value="{{ old('nomor', $paket->negoHarga->nomor) }}"  id="nomor" title="kolom nomor di larang kosong" placeholder="Nomor..." required/>
                                                {!! $errors->first('nomor', '<label id="nomor-error" class="error invalid-feedback" for="nomor">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" readonly name="tanggal" value="{{ old('tanggal', empty($paket->negoHarga->tanggal) ? $paket->evaluasiPenawaran->tanggal : $paket->negoHarga->tanggal) }}"  id="tanggal" title="kolom tanggal di larang kosong" placeholder="Nomor..." required/>
                                                {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Jam:<span class="text-danger">*</span></label>
                                                <input type="time" class="form-control {{ $errors->has('pukul') ? 'is-invalid' : '' }}" autocomplete="off" readonly name="pukul" value="{{ old('pukul', empty($paket->negoHarga->pukul) ? $paket->evaluasiPenawaran->jam : $paket->negoHarga->pukul) }}" id="pukul" title="kolom pukul di larang kosong" required />
                                                {!! $errors->first('pukul', '<label id="pukul-error" class="error invalid-feedback" for="pukul">:message</label>')!!}
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input type="hidden" id="paket_id_value" value="{{ $paket->id }}">
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
                                            <div class="mb-2 fw-bold">
                                                I. Uraian Klarifikasi mengenai
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Uraian Klarifikasi:<span class="text-danger">*</span></label>
                                                <input type="hidden" name="uraian_klarifikasi" id="uraian_klarifikasi" value="{{ old('uraian_klarifikasi', $paket->negoHarga->uraian_klarifikasi) }}">
                                                <div id="editor" style="min-height: 160px;">{!! old('uraian_klarifikasi', $paket->negoHarga->uraian_klarifikasi) !!}</div>
                                                {!! $errors->first('uraian_klarifikasi', '<label id="uraian_klarifikasi-error" class="error invalid-feedback" for="uraian_klarifikasi">:message</label>')!!}
                                            </div>
                                            <div class="mb-2 fw-bold">
                                                II.	Uraian negosiasi
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Penawaran Rekanan:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('penawaran_rekanan') ? 'is-invalid' : '' }}" autocomplete="off" name="penawaran_rekanan" value="{{ old('penawaran_rekanan', $paket->negoHarga->penawaran_rekanan) }}" id="penawaran_rekanan" title="kolom penawaran rekanan di larang kosong" placeholder="Penawaran Rekanan..." required />
                                                    {!! $errors->first('penawaran_rekanan', '<label id="penawaran_rekanan-error" class="error invalid-feedback" for="penawaran_rekanan">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Penawaran Rekanan (Terbilang):<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control {{ $errors->has('penawaran_rekanan_terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="penawaran_rekanan_terbilang" value="{{ old('penawaran_rekanan_terbilang', $paket->negoHarga->penawaran_rekanan_terbilang) }}" id="penawaran_rekanan_terbilang" title="kolom penawaran rekanan terbilang di larang kosong" placeholder="Penawaran diajukan Terbilang..." required />
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="penawaran_rekanan_terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('penawaran_rekanan_terbilang', '<label id="penawaran_rekanan_terbilang-error" class="error invalid-feedback" for="penawaran_rekanan_terbilang">:message</label>')!!}
                                                </div>
                                                <small class="text-info">Perbaiki secara manual jika terjadi kesalahan</small>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Penawaran diAjukan:<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('penawaran_diajukan') ? 'is-invalid' : '' }}" autocomplete="off" name="penawaran_diajukan" value="{{ old('penawaran_diajukan', $paket->negoHarga->penawaran_diajukan) }}" id="penawaran_diajukan" title="kolom penawaran diajukan di larang kosong" placeholder="Penawaran diajukan..." required />
                                                    {!! $errors->first('penawaran_diajukan', '<label id="penawaran_diajukan-error" class="error invalid-feedback" for="penawaran_diajukan">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Penawaran diAjukan (Terbilang):<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control {{ $errors->has('penawaran_diajukan_terbilang') ? 'is-invalid' : '' }}" autocomplete="off" name="penawaran_diajukan_terbilang" value="{{ old('penawaran_diajukan_terbilang', $paket->negoHarga->penawaran_diajukan_terbilang) }}" id="penawaran_diajukan_terbilang" title="kolom penawaran diAjukan terbilang di larang kosong" placeholder="Penawaran diajukan Terbilang..." required />
                                                    <button class="btn input-group-text btn-dark waves-effect waves-light" type="button" id="terbilang_rupiah"><i class="fas fa-sync-alt"></i></button>
                                                    {!! $errors->first('penawaran_diajukan_terbilang', '<label id="penawaran_diajukan_terbilang-error" class="error invalid-feedback" for="penawaran_diajukan_terbilang">:message</label>')!!}
                                                </div>
                                                <small class="text-info">Perbaiki secara manual jika terjadi kesalahan</small>
                                            </div>
                                            <div class="mb-2 fw-bold">
                                                III. Kesimpulan
                                            </div>
                                            @if ($paket->vendor_id == NULL)
                                                <div class="mb-2 fw-bold">
                                                    <label for="example-input-normal" class="form-label text-danger">BELUM ADA PEMENANG DARI TENDER, SILAHKAN TENTUKAN PEMENANG 
                                                        <a href="{{ route('admin.hasil-evaluasi-penawaran.edit', $paket->id) }}">
                                                            HASIL EVALUASI PENAWARAN 
                                                        </a>
                                                    </label>
                                                </div>
                                            @endif
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Nama Penyedia: </label>
                                                <span class="fw-bold"> {{ $paket->vendor->nama_perusahaan  }} </span>
                                                <input type="hidden" name="vendor_id" value="{{ $paket->vendor_id }}">
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Hasil Negosiasi :<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('hasil_nego') ? 'is-invalid' : '' }}" autocomplete="off" name="hasil_nego" value="{{ old('hasil_nego', $paket->negoHarga->hasil_nego) }}" id="hasil_nego" title="kolom hasil negosiasi di larang kosong" placeholder="hasil negosiasi..." required />
                                                    {!! $errors->first('hasil_nego', '<label id="hasil_nego-error" class="error invalid-feedback" for="hasil_nego">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Harga Akhir :<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <span class="btn input-group-text btn-dark waves-effect waves-light">Rp. </span>
                                                    <input type="text" class="form-control rupiah {{ $errors->has('harga_final') ? 'is-invalid' : '' }}" autocomplete="off" name="harga_final" value="{{ old('harga_final', $paket->negoHarga->harga_final) }}" id="harga_final" title="kolom hasil negosiasi di larang kosong" placeholder="hasil negosiasi..." required />
                                                    {!! $errors->first('harga_final', '<label id="harga_final-error" class="error invalid-feedback" for="harga_final">:message</label>')!!}
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <button type="submit"class="btn btn-info width-md waves-effect waves-light">
                                                    <i class="fa fa-save"></i> SIMPAN
                                                </button>
                                                <a href="{{ route('admin.surat-perjanjian.edit', $paket->id) }}" class="btn btn-primary width-md waves-effect waves-light float-end">
                                                    SURAT PERJANJIAN <i class="fe-arrow-right"></i>
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
<script src="{{ asset('backend/js/mask/dist/jquery.mask.js') }}"></script>
<script src="{{ asset('template/barangjasa/admin/nego-harga.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
