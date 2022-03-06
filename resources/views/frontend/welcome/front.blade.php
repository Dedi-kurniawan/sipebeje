<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>SIPEBEJE | Sistem Informasi Pengadaan Barang/Jasa Desa Bengkulu Utara</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Sistem Informasi Pengadaan Barang/Jasa Desa Bengkulu Utara" name="description" />
        <meta content="SIPEBEJE" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="{{ asset('template/images/logo/favicon.ico') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/materialdesignicons.min.css') }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/style.css') }}"/>
        <link href="{{ asset('backend/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('backend/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body data-bs-spy="scroll" data-bs-target=".navbar" data-bs-offset="78">

        <!--Navbar Start-->
        <nav class="navbar navbar-expand-lg fixed-top navbar-custom sticky-dark" id="sticky">
            <div class="container-fluid">
                <!-- LOGO -->
                <a class="logo text-uppercase" href="index.html">
                    <img src="{{ asset('template/images/logo/logo-light.png') }}" alt="" class="logo-light" height="30" />
                    <img src="{{ asset('template/images/logo/logo-dark.png') }}" alt="" class="logo-dark" height="30" />
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mx-auto navbar-center" id="mySidenav">
                        <li class="nav-item">
                            <a href="#home" class="nav-link">Beranda</a>
                        </li>
                        {{-- <li class="nav-item">
                            <a href="#features" class="nav-link">Features</a>
                        </li> --}}
                        <li class="nav-item">
                            <a href="#contact" class="nav-link">Kontak Kami</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('frontend.register.index') }}" class="nav-link">Daftar Vendor</a>
                        </li>
                    </ul>
                    @guest
                        <a href="{{ route('frontend.login') }}" class="btn btn-info navbar-btn">Login</a>
                    @else
                        <a href="{{ route('admin.dashboard.index') }}" class="btn btn-info navbar-btn">Dashboard</a>
                    @endguest                     
                </div>
            </div>
        </nav>
        <section class="bg-home bg-gradient" id="home">
            <div class="home-center">
                <div class="home-desc-center">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="home-title mo-mb-20">
                                    <h1 class="mb-4 text-white">SIPEBEJE Bengkulu Utara</h1>
                                    <p class="text-white-50 home-desc mb-5">Sistem Informasi Pengadaan Barang/Jasa Desa Bengkulu Utara <br> - Dinas Pemberdayaan Masyarakat dan Desa </p>
                                </div>
                            </div>
                            <div class="col-xl-4 offset-xl-2 col-lg-5 offset-lg-1 col-md-7">
                                <div class="home-img position-relative">
                                    <img src="https://jagaratusamban.bengkuluutarakab.go.id/sliders/5.jpeg" alt="" class="home-first-img">
                                    <img src="https://jagaratusamban.bengkuluutarakab.go.id/sliders/5.jpeg" alt="" class="home-second-img mx-auto d-block">
                                    <img src="https://jagaratusamban.bengkuluutarakab.go.id/sliders/5.jpeg" alt="" class="home-third-img">
                                </div>
                            </div>
                        </div>
                        <!-- end row -->
                    </div>
                    <!-- end container-fluid -->
                </div>
            </div>
        </section>
        <section>
            <div class="container-fluid">
                <div class="clients p-4 bg-white">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="client-images text-center">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['desa'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">TOTAL DESA</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-images text-center">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['vendor'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">TOTAL VENDOR</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-images text-center">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['paket_semua'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">TOTAL PAKET</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="client-images text-center">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['paket_selesai'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">PAKET SELESAI</p>
                            </div>
                        </div>
                    </div> <!-- end row -->
                </div>
            </div> <!-- end container-fluid -->
        </section>
        <section class="section-sm" id="features">
            <div class="container-fluid">
                {{-- <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-4 pb-1">
                            <h3 class="mb-3">The admin is fully responsive and easy to customize</h3>
                            <p class="text-muted">The clean and well commented code allows easy customization of the theme.It's designed for describing your app, agency or business.</p>
                        </div>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-lg">
                            <form method="GET" action="{{ route('frontend.welcome.index') }}" class="d-flex flex-wrap align-items-center">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="me-sm-3">
                                                <label for="status-select" class="me-2">Kecamatan</label>
                                                <select name="desa" class="form-select my-1 my-md-0 select_filter" id="kecamatan_filter">
                                                    @foreach ($kecamatan as $k)
                                                        <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="me-sm-3">
                                                <label for="status-select" class="me-2">Desa</label>
                                                <select name="kecamatan" class="form-select my-1 my-md-0 select_filter" id="desa_filter"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for=""></label>
                                            <div class="text-md-start d-grid gap-2">
                                                <button type="submit" class="btn btn-info waves-effect waves-light btn-block" id="button_filter"><i class="mdi mdi-file-find me-1"></i> Cari</button>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </form>
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card shadow-lg">
                            <div class="card-body p-0">
                                <table id="datatable" class="table nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Desa</th>
                                            <th>Pagu Anggaran</th>
                                            <th>Akhir Pendaftaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp
                                        @forelse ($paket as $p)
                                            <tr>
                                                <td>{{ $no++ }}</td>
                                                <td>{{ ucwords(strtolower($p->akk->dp_bidang)) }}, {{ ucwords(strtolower($p->akk->dp_subbidang)) }}</td>
                                                <td>{{ $p->desa->nama }}</td>
                                                <td>Rp. {{ number_format($p->hps) }}</td>
                                                <td>{!! $p->TanggalSelesaiAt !!}</td>
                                            </tr>
                                        @empty                                
                                        @endforelse
                                    </tbody>
                                </table>
                            </div> <!-- end card body-->
                        </div> <!-- end card -->
                    </div><!-- end col-->
                </div>
            </div>
        </section>
        <section class="section bg-gradient" id="contact">
            {{-- <div class="bg-shape">
                <img src="{{ asset('frontend/images/bg-shape-light.png') }}" alt="" class="img-fluid mx-auto d-block">
            </div> --}}
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="title text-center mb-4">
                            <h3 class="text-white">Kontak Kami</h3>
                            <p class="text-white-50">Dinas Pemberdayaan Masyarakat dan Desa Bengkulu Utara</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <div class="contact-content text-center mt-4">
                            <div class="contact-icon mb-2">
                                <i class="mdi mdi-email-outline text-info h2"></i>
                            </div>
                            <div class="contact-details text-white">
                                <h6 class="text-white">E-mail</h6>
                                <p class="text-white-50">dpmd@bengkuluutarakab.go.id</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-4">
                        <div class="contact-content text-center mt-4">
                            <div class="contact-icon mb-2">
                                <i class="mdi mdi-cellphone-iphone text-info h2"></i>
                            </div>
                            <div class="contact-details">
                                <h6 class="text-white">Telepon</h6>
                                <p class="text-white-50">0737 - 522540</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-md-4">
                        <div class="contact-content text-center mt-4">
                            <div class="contact-icon mb-2">
                                <i class="mdi mdi-map-marker text-info h2"></i>
                            </div>
                            <div class="contact-details">
                                <h6 class="text-white">Alamat</h6>
                                <p class="text-white-50">Jl. Soekarno, Kota Arga Makmur</p>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
            </div>
            <!-- end container-fluid -->
        </section>
        <footer class="bg-dark footer">
            <div class="container-fluid">
                <div class="row mb-5">
                    <div class="col-lg-4">
                        <div class="pe-lg-4">                            
                            <p class="text-white mb-2 footer-list-title">TENTANG</p>
                            <div class="mb-4">
                                <img src="{{ asset('template/images/logo/logo-light.png') }}" alt="" height="30">
                            </div>
                            <p class="text-white-50 mb-4 mb-lg-0">Sistem Informasi Pengadaan Barang/Jasa Desa Bengkulu Utara</p>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-6">
                        <div class="footer-list">
                            <p class="text-white mb-2 footer-list-title">LOKASI</p>
                            <ul class="list-unstyled">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4078199.8263362464!2d99.92906236250003!3d-3.4429596999999954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e315bddc11ccb59%3A0xa768a5405cd77ca7!2sBPMPD%20Bengkulu%20Utara!5e0!3m2!1sid!2sid!4v1646450680260!5m2!1sid!2sid" width="250" height="150" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="footer-list">
                            <p class="text-white mb-2 footer-list-title">LINK TERKAIT</p>
                            <ul class="list-unstyled">
                                <li><a href="https://bengkuluutarakab.go.id/"><i class="mdi mdi-chevron-right me-2"></i>Pemkab Bengkulu Utara</a></li>
                                <li><a href="https://jagaratusamban.bengkuluutarakab.go.id/"><i class="mdi mdi-chevron-right me-2"></i>Jaga Ratu Samban</a></li>
                                <li><a href="http://dpmd.bengkuluprov.go.id/"><i class="mdi mdi-chevron-right me-2"></i>DPMD Provinsi Bengkulu Utara</a></li>
                                <li><a href="https://kemendesa.go.id/"><i class="mdi mdi-chevron-right me-2"></i>KEMENDES</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="float-start pull-none">
                            <p class="text-white-50"><script>document.write(new Date().getFullYear())</script> &copy; Dinas Pemberdayaan Masyarakat dan Desa Bengkulu Utara</a> </p>
                            <!-- <p class="text-white-50">2015 - 2020 © Ubold. Design by <a href="https://coderthemes.com/" target="_blank" class="text-white-50">Coderthemes</a> </p> -->
                        </div>
                        <div class="float-end pull-none">
                            <ul class="list-inline social-links">
                                <li class="list-inline-item text-white-50">
                                    Aplikasi SIPEBEJE Vesi 1.0
                                </li>
                                {{-- <li class="list-inline-item"><a href="#"><i class="mdi mdi-facebook"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-twitter"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-instagram"></i></a></li>
                                <li class="list-inline-item"><a href="#"><i class="mdi mdi-google-plus"></i></a></li> --}}
                            </ul>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </footer>
        <script>
            var HOST_URL = "{{ url('/') }}";
        </script>
        <a href="#" onclick="topFunction()" class="back-to-top-btn btn btn-primary" id="back-to-top-btn"><i class="mdi mdi-chevron-up"></i></a>
        <script src="{{ asset('frontend/js/app.js') }}"></script>
        {{-- <script src="{{ asset('backend/js/vendor.min.js') }}"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="{{ asset('backend/libs/select2/js/select2.min.js') }}"></script>
        <script src="{{ asset('backend/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('backend/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('backend/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('backend/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('backend/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('backend/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
        <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/barangjasa/frontend/welcome.js') }}?{{ date('Ymdhis') }}"></script>
        
    </body>

</html>