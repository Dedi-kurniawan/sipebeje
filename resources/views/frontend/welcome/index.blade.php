@section('title', 'Beranda')
@extends('layouts.frontend.master')
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
                    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="https://images.unsplash.com/photo-1646041293273-788e7543dd3d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1169&q=30" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://images.unsplash.com/photo-1644916081706-e98b1fadc319?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=30" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="https://images.unsplash.com/photo-1644946882015-cbc3c92d0526?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=30" alt="Third slide">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleInterval" role="button" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleInterval" role="button" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-blue rounded">
                                <i class="fe-home avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['desa'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">TOTAL DESA</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{--  <h6 class="text-uppercase">Target <span class="float-end">60%</span></h6>  --}}
                        <div class="progress progress-sm m-0">
                            <div class="progress-bar bg-blue" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                {{--  <span class="visually-hidden">60% Complete</span>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-success rounded">
                                <i class="fe-award avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['vendor'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">TOTAL VENDOR</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{--  <h6 class="text-uppercase">Target <span class="float-end">49%</span></h6>  --}}
                        <div class="progress progress-sm m-0">
                            <div class="progress-bar bg-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                {{--  <span class="visually-hidden">49% Complete</span>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-warning rounded">
                                <i class="fe-bar-chart-2 avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['paket_semua'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">TOTAL PAKET</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{--  <h6 class="text-uppercase">Target <span class="float-end">18%</span></h6>  --}}
                        <div class="progress progress-sm m-0">
                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                {{--  <span class="visually-hidden">18% Complete</span>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end card-->
        </div> <!-- end col -->

        <div class="col-md-6 col-xl-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="avatar-sm bg-info rounded">
                                <i class="fe-bar-chart-line avatar-title font-22 text-white"></i>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-end">
                                <h3 class="text-dark my-1"><span data-plugin="counterup">{{ $data['paket_selesai'] }}</span></h3>
                                <p class="text-muted mb-1 text-truncate">PAKET SELESAI</p>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        {{--  <h6 class="text-uppercase">Target <span class="float-end">74%</span></h6>  --}}
                        <div class="progress progress-sm m-0">
                            <div class="progress-bar bg-info" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                {{--  <span class="visually-hidden">74% Complete</span>  --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
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
                                <div class="text-md-start">
                                    <button type="submit" class="btn btn-info waves-effect waves-light" id="button_filter"><i class="fa fa-search me-1"></i> Cari</button>
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
            <div class="card">
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
@endsection
@push('scripts')
<script src="{{ asset('backend/libs/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('template/barangjasa/frontend/welcome.js') }}?{{ date('Ymdhis') }}"></script>
@endpush
