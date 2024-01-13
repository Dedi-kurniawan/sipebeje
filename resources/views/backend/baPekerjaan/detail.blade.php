@extends('layouts.backend.master')
@section('title', $bread['first'])
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $bread['first'] }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form id="form_validate" method="POST" action="{{ route('admin.ba-pekerjaan.update', $edit->id) }}">
                        @csrf
                        @method('PUT')
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-mail me-1"></i> FORMULIR BERITA ACARA SERAH TERIMA PEKRJAAN </h5>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nomor_surat') ? 'is-invalid' : '' }}" autocomplete="off" name="nomor_surat" value="{{ old('nomor_surat', $edit->nomor_surat) }}"  id="nomor_surat" title="kolom nomor surat di larang kosong" placeholder="nomor surat..." required/>
                            {!! $errors->first('nomor_surat', '<label id="nomor_surat-error" class="error invalid-feedback" for="nomor_surat">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <h5>PIHAK PERTAMA</h5>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Kepala Desa:<span class="text-danger">*</span></label>
                            <select name="kepala_desa_id" class="form-control selectFormClass {{ $errors->has('kepala_desa_id') ? 'is-invalid' : '' }}" id="kepala_desa_id" required title="Kolom pihak pertama nama di larang kosong">
                                <option value="">Pilih Kepala Desa</option>
                                @foreach ($aparatur as $a)
                                    <option value="{{ $a->id }}" {{ old('kepala_desa_id', $edit->kepala_desa_id) == $a->id ? "selected" : "" }}>{{ $a->nama }} - {{ $a->jabatan }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('kepala_desa_id', '<label id="kepala_desa_id-error" class="error invalid-feedback" for="kepala_desa_id">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Alamat:<span class="text-danger">*</span></label>
                            <textarea name="alamat_kepala_desa" id="alamat_kepala_desa" class="form-control {{ $errors->has('alamat_kepala_desa') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom pihak pertama alamat di larang kosong" required>{{ old('alamat_kepala_desa', $edit->alamat_kepala_desa) }}</textarea>
                            {!! $errors->first('alamat_kepala_desa', '<label id="alamat_kepala_desa-error" class="error invalid-feedback" for="alamat_kepala_desa">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <h5>PIHAK KEDUA</h5>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Ketua (TPK):<span class="text-danger">*</span></label>
                            <select name="aparatur_id" class="form-control selectFormClass {{ $errors->has('aparatur_id') ? 'is-invalid' : '' }}" id="aparatur_id" required title="Kolom pihak pertama nama di larang kosong">
                                <option value="">Pilih Ketua (TPK)</option>
                                @foreach ($aparatur as $a)
                                    <option value="{{ $a->id }}" {{ old('aparatur_id', $edit->aparatur_id) == $a->id ? "selected" : "" }}>{{ $a->nama }} - {{ $a->jabatan }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('aparatur_id', '<label id="aparatur_id-error" class="error invalid-feedback" for="aparatur_id">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Alamat:<span class="text-danger">*</span></label>
                            <textarea name="alamat_aparatur" id="alamat_aparatur" class="form-control {{ $errors->has('alamat_aparatur') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom pihak kedua alamat di larang kosong" required>{{ old('alamat_aparatur', $edit->alamat_aparatur) }}</textarea>
                            {!! $errors->first('alamat_aparatur', '<label id="alamat_aparatur-error" class="error invalid-feedback" for="alamat_aparatur">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal" value="{{ old('tanggal', $edit->tanggal) }}"  id="tanggal" title="kolom tanggal selesai di larang kosong" placeholder="Akhir Pendaftaran..." required/>
                            {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Tanggal Nota Barang:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control {{ $errors->has('tanggal_nota_barang') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal_nota_barang" value="{{ old('tanggal_nota_barang', $edit->tanggal_nota_barang) }}"  id="tanggal_nota_barang" title="kolom tanggal nota barang selesai di larang kosong" placeholder="tanggal nota barang..." required/>
                            {!! $errors->first('tanggal_nota_barang', '<label id="tanggal_nota_barang-error" class="error invalid-feedback" for="tanggal_nota_barang">:message</label>')!!}
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-2">
                                <button type="button" class="btn btn-sm btn-blue waves-effect waves-light float-start" id="createData">
                                    <i class="mdi mdi-plus-circle"></i> Tambah Rincian
                                </button>
                            </div>
                            <div class="col-12 mb-2">
                                <table id="datatable" class="table dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Uraian Barang</th>
                                            <th>Volume</th>
                                            <th>Satuan</th>
                                            <th>CheckList</th>
                                            <th>Keterangan</th>
                                            <th>AKSI</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                        <div class="text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('backend.baPekerjaan._form_detail')
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/ba-pekerjaan-detail.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
