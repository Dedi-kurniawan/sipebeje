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
                        <h5 class="mb-4 text-uppercase">
                            <i class="mdi mdi-mail me-1"></i> FORMULIR BERITA ACARA SERAH TERIMA PEKRJAAN
                        </h5>
                        <div class="col-12 mb-2">
                            <label for="example-input-normal" class="form-label">Nomor:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control {{ $errors->has('nomor_surat') ? 'is-invalid' : '' }}" autocomplete="off" readonly name="nomor_surat" value="{{ old('nomor_surat', $edit->nomor_surat) }}"  id="nomor_surat" title="kolom nomor surat di larang kosong" placeholder="nomor surat..." required/>
                            {!! $errors->first('nomor_surat', '<label id="nomor_surat-error" class="error invalid-feedback" for="nomor_surat">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Tanggal:<span class="text-danger">*</span></label>
                            <input type="date" class="form-control {{ $errors->has('tanggal') ? 'is-invalid' : '' }}" autocomplete="off" readonly name="tanggal" value="{{ old('tanggal', $edit->tanggal) }}"  id="tanggal" title="kolom tanggal selesai di larang kosong" placeholder="Akhir Pendaftaran..." required/>
                            {!! $errors->first('tanggal', '<label id="tanggal-error" class="error invalid-feedback" for="tanggal">:message</label>')!!}
                        </div>
                        <div class="mb-2">
                            <label for="example-input-normal" class="form-label">Paket:<span class="text-danger">*</span></label>
                            <input type="text" class="form-control" value="{{ $edit->paket->nama }}"  readonly/>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12 mb-2">
                                <table class="table dt-responsive w-100">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Uraian Barang</th>
                                            <th>Volume</th>
                                            <th>CheckList</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($details as $key => $x)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $x->uraian }}</td>
                                                <td>{{ $x->volume }} {{ $x->satuan }}</td>
                                                <td>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="details[{{ $x->id }}][checklist]" value="Ada" id="radio1{{ $x->id }}" {{ $x->checklist == 'Ada' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="radio1{{ $x->id }}">Ada</label>
                                                    </div>
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" name="details[{{ $x->id }}][checklist]" value="Tidak Ada" id="radio2{{ $x->id }}" {{ $x->checklist == 'Tidak Ada' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="radio2{{ $x->id }}">Tidak Ada</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea name="details[{{ $x->id }}][keterangan]" class="form-control" id="keterangan_{{ $x->id }}" cols="30" rows="3">{{ $x->checklist_keterangan }}</textarea>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
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
{{-- @include('backend.baPekerjaan._form_detail') --}}
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/ba-pekerjaan-detail.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
