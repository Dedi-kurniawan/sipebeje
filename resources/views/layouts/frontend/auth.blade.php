<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SIPEBEJE | @yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="SIPEBEJE" name="description" />
        <meta content="SIPEBEJE" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{ asset('template/images/logo/favicon.ico') }}">
        <link href="{{ asset('backend/libs/jquery-toast-plugin/jquery.toast.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/css/config/default/bootstrap.min.css') }}" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="{{ asset('backend/css/config/default/app.min.css') }}" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        <link href="{{ asset('backend/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="{{ asset('backend/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
        <link href="{{ asset('backend/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="loading authentication-bg authentication-bg-pattern">
        @yield('content')
        <footer class="footer footer-alt">
            <script>document.write(new Date().getFullYear())</script> &copy; Dinas Pemberdayaan Masyarakat dan Desa <a href="">Bengkulu Utara</a> 
        </footer>
        <script src="{{ asset('backend/js/vendor.min.js') }}"></script>
        <script src="{{ asset('backend/libs/jquery-toast-plugin/jquery.toast.min.js') }}"></script>     
        <script src="{{ asset('backend/js/app.min.js') }}"></script>
        <script src="{{ asset('backend/js/jquery-validation/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('template/barangjasa/base.js') }}?{{ date('Ymdhis') }}"></script>  
        @stack('scripts')     
    </body>
</html>