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
                    <form id="form_validate" method="POST" action="{{ route('admin.surat-pesanan.update', $edit->id) }}">
                        @csrf
                        @method('PUT')
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-mail me-1"></i> FORMULIR SURAT PESANAN BARU </h5>
                        <div class="row">
                            <div class="col-12 mb-2">
                                <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                                <input type="text" class="form-control {{ $errors->has('nomor_surat') ? 'is-invalid' : '' }}" autocomplete="off" name="nomor_surat" value="{{ old('nomor_surat', $edit->nomor_surat) }}"  id="nomor_surat" title="kolom nomor surat di larang kosong" placeholder="nomor surat..." required/>
                                {!! $errors->first('nomor_surat', '<label id="nomor_surat-error" class="error invalid-feedback" for="nomor_surat">:message</label>')!!}
                            </div>
                            <div class="col-12 mb-2">
                                <label for="example-input-normal" class="form-label">Ketua TPK:<span class="text-danger">*</span></label>
                                <select name="aparatur_id" class="form-control selectForm {{ $errors->has('aparatur_id') ? 'is-invalid' : '' }}" id="aparatur_id" required title="Kolom ketua tpk di larang kosong">
                                    <option value="">Pilih Ketua TPK</option>
                                    @foreach ($aparatur as $a)
                                        <option value="{{ $a->id }}" {{ old('aparatur_id', $edit->aparatur_id) == $a->id ? "selected" : "" }}>{{ $a->nama }} - {{ $a->jabatan }}</option>
                                    @endforeach
                                </select>
                                {!! $errors->first('aparatur_id', '<label id="aparatur_id-error" class="error invalid-feedback" for="aparatur_id">:message</label>')!!}
                            </div>
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Alamat Ketua TPK:<span class="text-danger">*</span></label>
                            <textarea name="alamat_aparatur" id="alamat_aparatur" class="form-control {{ $errors->has('alamat_aparatur') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom alamat ketua tpk di larang kosong" required>{{ old('alamat_aparatur', $edit->alamat_aparatur) }}</textarea>
                            {!! $errors->first('alamat_aparatur', '<label id="alamat_aparatur-error" class="error invalid-feedback" for="alamat_aparatur">:message</label>')!!}
                        </div>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Penyedia:<span class="text-danger">*</span></label>
                            <select name="vendor_id" class="form-control selectForm {{ $errors->has('vendor_id') ? 'is-invalid' : '' }}" id="vendor_id" required title="Kolom penyedia di larang kosong">
                                <option value="">Pilih Penyedia</option>
                                @foreach ($vendor as $a)
                                    <option value="{{ $a->id }}" {{ old('vendor_id', $edit->vendor_id) == $a->id ? "selected" : "" }}>{{ $a->nama_perusahaan }} - {{ $a->name_vendor }}</option>
                                @endforeach
                            </select>
                            {!! $errors->first('vendor_id', '<label id="vendor_id-error" class="error invalid-feedback" for="vendor_id">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal" value="{{ old('tanggal', $edit->tanggal) }}"  id="tanggal" title="kolom tanggal selesai di larang kosong" placeholder="Akhir Pendaftaran..." required/>
                            {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Tanggal barang diterima paling lambat:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control {{ $errors->has('tanggal_lambat') ? 'is-invalid' : '' }}" autocomplete="off" name="tanggal_lambat" value="{{ old('tanggal_lambat', $edit->tanggal_lambat) }}"  id="tanggal_lambat" title="kolom tanggal lambat selesai di larang kosong" placeholder="Akhir Pendaftaran..." required/>
                            {!! $errors->first('tanggal_lambat', '<label id="tanggal_lambat-error" class="error invalid-feedback" for="tanggal_lambat">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label"> Dibebankan Kepada:<span class="text-danger">*</span></label>
                            <textarea name="beban_kepada" id="beban_kepada" class="form-control {{ $errors->has('beban_kepada') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom beban kepada di larang kosong" required>{{ old('beban_kepada', $edit->beban_kepada) }}</textarea>
                            {!! $errors->first('beban_kepada', '<label id="beban_kepada-error" class="error invalid-feedback" for="beban_kepada">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Jenis Belanja:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('jenis_belanja') ? 'is-invalid' : '' }}" autocomplete="off" name="jenis_belanja" value="{{ old('jenis_belanja', $edit->jenis_belanja) }}"  id="jenis_belanja" title="kolom jenis belanja selesai di larang kosong" placeholder="Jenis Belanja..." required/>
                            {!! $errors->first('jenis_belanja', '<label id="jenis_belanja-error" class="error invalid-feedback" for="jenis_belanja">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label"> Uraian rincian Jenis Belanja:<span class="text-danger">*</span></label>
                            <textarea name="uraian_jenis_belanja" id="uraian_jenis_belanja" class="form-control {{ $errors->has('uraian_jenis_belanja') ? 'is-invalid' : '' }}" cols="3" rows="3" title="Kolom uraian rincian jenis belanja di larang kosong" required>{{ old('uraian_jenis_belanja', $edit->uraian_jenis_belanja) }}</textarea>
                            {!! $errors->first('uraian_jenis_belanja', '<label id="uraian_jenis_belanja-error" class="error invalid-feedback" for="uraian_jenis_belanja">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">PPN:<span class="text-danger">*</span></label>
                            <input type="number" class="form-control {{ $errors->has('ppn') ? 'is-invalid' : '' }}" autocomplete="off" name="ppn" value="{{ old('ppn', $edit->ppn) }}"  id="ppn" title="kolom ppn selesai di larang kosong" placeholder="PPN..." required/>
                            {!! $errors->first('ppn', '<label id="ppn-error" class="error invalid-feedback" for="ppn">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">PPH:<span class="text-danger">*</span></label>
                            <input type="number" class="form-control {{ $errors->has('pph') ? 'is-invalid' : '' }}" autocomplete="off" name="pph" value="{{ old('pph', $edit->pph) }}"  id="pph" title="kolom pph selesai di larang kosong" placeholder="pph..." required/>
                            {!! $errors->first('pph', '<label id="pph-error" class="error invalid-feedback" for="pph">:message</label>')!!}
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
                                            <th>SP</th>
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
@include('backend.suratPesanan._form_detail')
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/surat-pesanan-detail.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
