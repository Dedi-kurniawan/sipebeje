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
                <div class="card-body p-0">
                    <table id="datatable" class="table nowrap w-100">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Paket</th>
                                <th>Desa</th>
                                <th>Hps</th>
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
                                    <td>
                                        <a href="{{ route('frontend.welcome.show', $p->id) }}">
                                            {{ $p->NamaFormat }}
                                        </a>
                                    </td>
                                    <td>{{ $p->desa->nama }}</td>
                                    <td>{{ $p->hps }}</td>
                                    <td>{!! $p->TanggalSelesaiAt !!}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">DATA TIDAK DI TEMUKAN</td>
                                </tr>
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
<script src="{{ asset('template/barangjasa/frontend/welcome.js') }}"></script>
@endpush
