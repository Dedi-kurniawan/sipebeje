@extends('layouts.backend.master')
@section('title', $bread['second'])
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

                    <h4 class="header-titl text-uppercase"> FORMULIR {{ $bread['second'] }}</h4>
                    <p class="mb-3">{{ $paket->nama }}</p>

                    <div id="rootwizard">
                        <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                            @include('backend.paket.stepdua._tab')
                        </ul>
                        <div class="tab-content mb-0 b-0 pt-0">
                            <div class="tab-pane {{ $tab == "hasil-evaluasi-penawaran" ? "active" : "" }}" id="first">
                                <form id="form_validate" class="form-horizontal mb-3">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">Vendor<span class="text-danger">*</span> ( Total vendor ikut tender : {{ $vendor->count() }} )</label>
                                                <input type="hidden" name="paket_id" value="{{ $paket->id }}" id="paket_id">
                                                <select class="form-control selectFormClass" id="vendor_id" name="vendor_id" required>
                                                    <option value="">PILIH VENDOR</option>
                                                    @foreach ($vendor as $v)
                                                        <option value="{{ $v->vendor_id }}">{{ $v->vendor->nama_perusahaan }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">NPWP<span class="text-danger">*</span></label>
                                                <div class="form-check">
                                                    <input type="radio" id="npwp" name="npwp" class="form-check-input" value="mn" required>
                                                    <label class="form-check-label" for="npwp">Memenuhi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="npwp" name="npwp" class="form-check-input" value="tm">
                                                    <label class="form-check-label" for="npwp">Tidak Memenuhi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">SURAT PENAWARAN<span class="text-danger">*</span></label>
                                                <div class="form-check">
                                                    <input type="radio" id="surat_penawaran" name="surat_penawaran" class="form-check-input" value="mn" required>
                                                    <label class="form-check-label" for="surat_penawaran">Memenuhi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="surat_penawaran" name="surat_penawaran" class="form-check-input" value="tm">
                                                    <label class="form-check-label" for="surat_penawaran">Tidak Memenuhi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">HARGA<span class="text-danger">*</span></label>
                                                <div class="form-check">
                                                    <input type="radio" id="harga" name="harga" class="form-check-input" value="mn" required>
                                                    <label class="form-check-label" for="harga">Memenuhi</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="harga" name="harga" class="form-check-input" value="tm">
                                                    <label class="form-check-label" for="harga">Tidak Memenuhi</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-3">
                                                <label for="example-input-normal" class="form-label">KESIMPULAN<span class="text-danger">*</span></label>
                                                <div class="form-check">
                                                    <input type="radio" id="kesimpulan" name="kesimpulan" class="form-check-input" value="lulus" required>
                                                    <label class="form-check-label" for="kesimpulan">Lulus</label>
                                                </div>
                                                <div class="form-check">
                                                    <input type="radio" id="kesimpulan" name="kesimpulan" class="form-check-input" value="tidak lulus">
                                                    <label class="form-check-label" for="kesimpulan">Tidak Lulus</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-info waves-effect waves-light" id="submitData">
                                                <i class="fa fa-save"></i> SIMPAN
                                            </button>
                                        </div>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <h5><span id="total_data"></span> total vendor sudah di evaluasi</h4>
                                    <table id="dt_hasil" class="table table-bordered nowrap w-100">
                                        <thead>
                                            <tr>
                                                <th>NO</th>
                                                <th>VENDOR</th>
                                                <th>NPWP</th>
                                                <th>SURAT PENAWARAN</th>
                                                <th>HARGA</th>
                                                <th>KESIMPULAN</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <hr>
                                <div class="mb-3 mt-4">
                                    <form action="{{ route('admin.hasil-evaluasi-penawaran.field', $paket->id) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary width-md waves-effect waves-light float-start">
                                            <i class="fe-save"></i> SELESAI
                                        </button>
                                        <a href="{{ route('admin.nego-harga.edit', $paket->id) }}" class="btn btn-success width-md waves-effect waves-light float-end">
                                            BERITA ACARA NEGO HARGA <i class="fe-arrow-right"></i>
                                        </a>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('template/barangjasa/admin/hasil-evaluasi-penawaran.js') }}?{{ date('ymdshi') }}"></script>
@include('layouts.frontend.partials.notif')
@endpush