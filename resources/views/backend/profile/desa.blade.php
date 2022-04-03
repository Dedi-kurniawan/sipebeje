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
                    <form id="form_validate" method="POST" action="{{ route('admin.profile.desa.post') }}" enctype="multipart/form-data">
                        @csrf
                        <h5 class="mb-4 text-uppercase"><i class="mdi mdi-account-circle me-1"></i> ADMIN DESA</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="firstname" class="form-label">Nama</label>
                                    <input type="text" readonly class="form-control" value="{{ $desa->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="lastname" class="form-label">E-mail</label>
                                    <input type="text" readonly class="form-control" value="{{ $desa->email }}">
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> DESA</h5>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Desa <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" class="form-control {{ $errors->has('nama') ? 'is-invalid' : '' }}" readonly id="nama" value="{{ old('nama', $desa->desa->nama) }}" placeholder="Nama perusahaan" required>
                                    {!! $errors->first('nama', '<label id="nama-error" class="error invalid-feedback" for="nama">:message</label>')!!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="kecamatan" class="form-label">Kecamatan <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control {{ $errors->has('kecamatan') ? 'is-invalid' : '' }}" readonly id="kecamatan" value="{{ old('kecamatan', $desa->desa->kecamatan->nama) }}" placeholder="Nama perusahaan" required>
                                    {!! $errors->first('kecamatan', '<label id="kecamatan-error" class="error invalid-feedback" for="kecamatan">:message</label>')!!}
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Logo <span class="text-danger">*</span></label> <br>
                                <img id="img" src="{{ $desa->desa->PhotoPath }}" class="rounded-circle img-thumbnail text-center" alt="profile-image" width="120" height="120">
                                <input style="visibility:hidden" accept="image/*" name="logo" type="file" id="image-upload">
                                <p></p>
                                <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light" id="image-label">
                                    <i class="fa fa-pen"></i> 
                                    upload logo
                                </button> <br>
                                <span class="form-text text-muted">Hanya mendukung: png, jpg, jpeg</span>
                                <p class="error-image text-danger font-italic text-small">{!! $errors->first('logo') !!}</p>
                            </div>
                        </div> --}}
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Kepala Desa <span class="text-danger">*</span></label>
                                <input name="kepala_desa" type="text" class="form-control {{ $errors->has('kepala_desa') ? 'is-invalid' : '' }}" id="kepala_desa" value="{{ old('kepala_desa', $desa->desa->kepala_desa) }}" placeholder="Kepala Desa" required>
                                {!! $errors->first('kepala_desa', '<label id="kepala_desa-error" class="error invalid-feedback" for="kepala_desa">:message</label>')!!}
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea name="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" id="alamat" rows="4" placeholder="Alamat..." required>{{ old('alamat', $desa->desa->alamat) }}</textarea>
                                {!! $errors->first('alamat', '<label id="alamat-error" class="error invalid-feedback" for="alamat">:message</label>')!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="example-input-normal" class="form-label">Tahun Berdiri<span class="text-danger">*</span></label>
                                    <select name="tahun_berdiri" id="tahun_berdiri" class="form-control selectFormClass {{ $errors->has('tahun_berdiri') ? 'is-invalid' : '' }}" required>
                                        <option value="">Tahun Berdiri</option>
                                        @for ($i = 1900; $i < date('Y')+5; $i++) 
                                            <option value="{{ $i }}" {{ old('tahun_berdiri', $desa->desa->tahun_berdiri) == $i ? "selected" : "" }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    {!! $errors->first('tahun_berdiri', '<label id="tahun_berdiri-error" class="error invalid-feedback" for="tahun_berdiri">:message</label>')!!}
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Pendamping Desa <span class="text-danger">*</span></label>
                                <input name="pendamping_desa" type="text" class="form-control {{ $errors->has('pendamping_desa') ? 'is-invalid' : '' }}" id="pendamping_desa" value="{{ old('pendamping_desa', $desa->desa->pendamping_desa) }}" placeholder="Pendamping Desa" required>
                                {!! $errors->first('pendamping_desa', '<label id="pendamping_desa-error" class="error invalid-feedback" for="pendamping_desa">:message</label>')!!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email', $desa->desa->email) }}" placeholder="email@desa.com">
                                    {!! $errors->first('email', '<label id="email-error" class="error invalid-feedback" for="email">:message</label>')!!}
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Handphone</label>
                                    <input name="telepon" type="text" class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}" value="{{ old('telepon', $desa->desa->telepon) }}" placeholder="0812123456789">
                                    {!! $errors->first('telepon', '<label id="telepon-error" class="error invalid-feedback" for="telepon">:message</label>')!!}
                                </div>
                            </div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2" id="submitData"><i class="mdi mdi-content-save"></i> UPDATE</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/profile-vendor.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush
