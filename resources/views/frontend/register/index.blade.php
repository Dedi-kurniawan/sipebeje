@section('title', 'Daftar akun vendor')
@extends('layouts.frontend.auth')
@section('content')
<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">
                    <div class="card-body p-4">                                
                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="#" class="logo logo-dark text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('template/images/logo/logo-dark.png') }}" alt="" height="30">
                                    </span>
                                </a>                    
                                <a href="#" class="logo logo-light text-center">
                                    <span class="logo-lg">
                                        <img src="{{ asset('template/images/logo/logo-light.png') }}" alt="" height="30">
                                    </span>
                                </a>
                            </div>
                            <p class="text-muted mb-4 mt-3">Daftar akun vendor</p>
                        </div>

                        <form action="{{ route('frontend.register.store') }}" id="form_validate" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="fullname" class="form-label">Nama lengkap</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" value="{{ old('name') }}" id="name" required title="kolom nama di larang kosong" placeholder="Nama lengkap..." />
                                {!! $errors->first('name', '<label id="name-error" class="error invalid-feedback" for="name">:message</label>')!!}
                            </div>
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email</label>
                                <input type="email" name="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" value="{{ old('email') }}" id="email" required title="kolom email di larang kosong" placeholder="E-mail..." />
                                {!! $errors->first('email', '<label id="email-error" class="error invalid-feedback" for="email">:message</label>')!!}
                                <small class="text-info">*pastikan email yang di gunakan email aktif</small>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="password..." required>
                                    {!! $errors->first('password', '<label id="password-error" class="error invalid-feedback" for="password">:message</label>')!!}
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                    
                                </div>
                                <small class="text-info">*Password minimal 8 karakter</small>
                            </div>
                            <div class="text-center d-grid">
                                <button class="btn btn-success" type="submit"> Daftar </button>
                            </div>
                        </form>
                    </div> 
                </div>

            </div> <!-- end col -->
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
</div>   
@endsection
