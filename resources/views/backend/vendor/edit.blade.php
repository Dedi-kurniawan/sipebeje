@extends('layouts.backend.master')
@section('title', $bread['first'])
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
                    {{-- {{ $errors }} --}}
                    <form id="form_validate" method="POST" action="{{ route('admin.vendor.update', $edit->id) }}">
                        @csrf
                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-account me-1"></i> PERSONAL AKUN</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <input type="hidden" name="user_id" value="{{ $edit->user->id }}">
                                    <label for="firstname" class="form-label">Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" id="nama" value="{{ old('name', $edit->user->name) }}" required placeholder="Nama">
                                    {!! $errors->first('name', '<label id="name-error" class="error invalid-feedback" for="name">:message</label>')!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">E-mail <span class="text-danger">*</span></label>
                                    <input type="text" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" value="{{ old('email', $edit->user->email) }}" required placeholder="E-mail">
                                    {!! $errors->first('email', '<label id="email-error" class="error invalid-feedback" for="email">:message</label>')!!}
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="password" minlength="8">
                                    {!! $errors->first('password', '<label id="password-error" class="error invalid-feedback" for="password">:message</label>')!!}
                                    <small class="text-danger">Kosongkan password jika tidak ingin di ubah</small>
                                </div>
                            </div>
                        </div>
                        <h5 class="mb-3 text-uppercase bg-light p-2"><i class="mdi mdi-office-building me-1"></i> PERUSAHAAN</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">Nama perusahaan <span class="text-danger">*</span></label>
                                    <input name="nama_perusahaan" type="text" class="form-control {{ $errors->has('nama_perusahaan') ? 'is-invalid' : '' }}" id="nama_perusahaan" value="{{ old('nama_perusahaan', $edit->nama_perusahaan) }}" placeholder="Nama perusahaan" required>
                                    {!! $errors->first('nama_perusahaan', '<label id="nama_perusahaan-error" class="error invalid-feedback" for="nama_perusahaan">:message</label>')!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="email_perusahaan" class="form-label">E-mail perusahaan <span class="text-danger">*</span></label>
                                    <input name="email_perusahaan" type="email" class="form-control {{ $errors->has('email_perusahaan') ? 'is-invalid' : '' }}" id="email_perusahaan" value="{{ old('email_perusahaan', $edit->email_perusahaan) }}" placeholder="Email perusahaan" required>
                                    {!! $errors->first('email_perusahaan', '<label id="email_perusahaan-error" class="error invalid-feedback" for="email_perusahaan">:message</label>')!!}
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="alamat" class="form-label">Alamat <span class="text-danger">*</span></label>
                                    <textarea name="alamat" class="form-control {{ $errors->has('alamat') ? 'is-invalid' : '' }}" id="alamat" rows="4" placeholder="Alamat..." required>{{ old('alamat', $edit->alamat) }}</textarea>
                                    {!! $errors->first('alamat', '<label id="alamat-error" class="error invalid-feedback" for="alamat">:message</label>')!!}
                                </div>
                            </div>
                        </div> 
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="nama_perusahaan" class="form-label">NPWP <span class="text-danger">*</span></label>
                                    <input name="npwp" type="text" class="form-control {{ $errors->has('npwp') ? 'is-invalid' : '' }}" id="npwp" value="{{ old('npwp', $edit->npwp) }}" placeholder="NPWP" required>
                                    {!! $errors->first('npwp', '<label id="npwp-error" class="error invalid-feedback" for="npwp">:message</label>')!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="telepon" class="form-label">Telepon<span class="text-danger">*</span></label>
                                    <input name="telepon" type="number" class="form-control {{ $errors->has('telepon') ? 'is-invalid' : '' }}" id="telepon" value="{{ old('telepon', $edit->telepon) }}" placeholder="Telepon" required>
                                    {!! $errors->first('telepon', '<label id="telepon-error" class="error invalid-feedback" for="telepon">:message</label>')!!}
                                </div>
                            </div>
                        </div>
                        <div class="text-start">
                            <button type="submit" class="btn btn-success waves-effect waves-light mt-2"><i class="mdi mdi-content-save"></i> SIMPAN</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
@include('layouts.frontend.partials.notif')
@endpush

