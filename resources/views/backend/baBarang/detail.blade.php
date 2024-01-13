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
                    <form id="form_validate" method="POST" action="{{ route('admin.ba-barang.update', $edit->id) }}">
                        @csrf
                        @method('PUT')
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-mail me-1"></i> FORMULIR BERITA ACARA SERAH TERIMA BARANG </h5>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nomor_surat') ? 'is-invalid' : '' }}" autocomplete="off" name="nomor_surat" value="{{ old('nomor_surat', $edit->nomor_surat) }}"  id="nomor_surat" title="kolom nomor surat di larang kosong" placeholder="nomor surat..." required/>
                            {!! $errors->first('nomor_surat', '<label id="nomor_surat-error" class="error invalid-feedback" for="nomor_surat">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <h5>PIHAK PERTAMA</h5>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Nama:<span class="text-danger">*</span></label>
                            <select name="aparatur_id" class="form-control selectFormClass {{ $errors->has('aparatur_id') ? 'is-invalid' : '' }}" id="aparatur_id" required title="Kolom pihak pertama nama di larang kosong">
                                <option value="">Pilih Nama</option>
                                @foreach ($aparatur as $a)
                                    <option value="{{ $a->id }}" {{ old('aparatur_id', $edit->aparatur_id) == $a->id ? "selected" : "" }}>{{ $a->nama }} - {{ $a->jabatan }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('aparatur_id', '<label id="aparatur_id-error" class="error invalid-feedback" for="aparatur_id">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Alamat:<span class="text-danger">*</span></label>
                            <textarea name="alamat_aparatur" id="alamat_aparatur" class="form-control {{ $errors->has('alamat_aparatur') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom pihak pertama alamat di larang kosong" required>{{ old('alamat_aparatur', $edit->alamat_aparatur) }}</textarea>
                            {!! $errors->first('alamat_aparatur', '<label id="alamat_aparatur-error" class="error invalid-feedback" for="alamat_aparatur">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <h5>PIHAK KEDUA</h5>
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Nama<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('vendor') ? 'is-invalid' : '' }}" autocomplete="off" name="vendor" value="{{ old('vendor', $edit->vendor) }}"  id="vendor" title="kolom pihak kedua nama di larang kosong" placeholder="nomor surat..." required/>
                            {!! $errors->first('vendor', '<label id="vendor-error" class="error invalid-feedback" for="vendor">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Alamat:<span class="text-danger">*</span></label>
                            <textarea name="vendor_alamat" id="vendor_alamat" class="form-control {{ $errors->has('vendor_alamat') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom pihak kedua alamat di larang kosong" required>{{ old('vendor_alamat', $edit->vendor_alamat) }}</textarea>
                            {!! $errors->first('vendor_alamat', '<label id="vendor_alamat-error" class="error invalid-feedback" for="vendor_alamat">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Jabatan<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('vendor_jabatan') ? 'is-invalid' : '' }}" autocomplete="off" name="vendor_jabatan" value="{{ old('vendor_jabatan', $edit->vendor_jabatan) }}"  id="vendor_jabatan" title="kolom pihak kedua jabatan di larang kosong" placeholder="nomor surat..." required/>
                            {!! $errors->first('vendor_jabatan', '<label id="vendor_jabatan-error" class="error invalid-feedback" for="vendor_jabatan">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal" value="{{ old('tanggal', $edit->tanggal) }}"  id="tanggal" title="kolom tanggal selesai di larang kosong" placeholder="Akhir Pendaftaran..." required/>
                            {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">PPN:<span class="text-danger">*</span></label>
                            <input type="number" class="form-control {{ $errors->has('ppn') ? 'is-invalid' : '' }}" autocomplete="off" name="ppn" value="{{ old('ppn', $edit->ppn) }}"  id="ppn" title="kolom ppn selesai di larang kosong" placeholder="PPN..." required/>
                            {!! $errors->first('ppn', '<label id="ppn-error" class="error invalid-feedback" for="ppn">:message</label>')!!}
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
                                            <th>Harga Satuan</th>
                                            <th>Total  Harga  (Rp)</th>
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
@include('backend.baBarang._form_detail')
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/ba-barang-detail.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
