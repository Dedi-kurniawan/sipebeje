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
                <h4 class="page-title text-uppercase">{{ $bread['third'] }}</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="w-100">
                        <thead class="text-center justify-content-center">
                            <tr>
                                <td colspan="2" class="fw-bold">TIM PENGELOLA KEGIATAN</td>
                            </tr>
                            <tr>
                                <td class="text-uppercase fw-bold" colspan="2">DESA {{ $show->desa->nama }} KECAMATAN {{ $show->desa->kecamatan->nama }}</td>
                            </tr>
                            <tr>
                                <td><hr></td>
                            </tr>
                        </thead>
                    <table>                            
                    <table class="w-100">
                        <tbody>
                            <tr>
                                <td></td>
                                <td></td>
                                <td class="float-end">{{ $show->undangan->CreatedAtFormat }}</td>
                            </tr>
                            <tr>
                                <td>Nomor</td>
                                <td>:</td>
                                <td>{{ $show->undangan->nomor }}</td>
                            </tr>
                            <tr>
                                <td>Lampiran</td>
                                <td>:</td>
                                <td>1 (satu) dokumen)</td>
                            </tr>
                            <tr>
                                <td>Kepada Yth.</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Pimpinan Penyedia {{ $undangan->vendor->nama_perusahaan }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Di {{ $undangan->vendor->alamat }}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Perihal</td>
                                <td>:</td>
                                <td>{{ $show->undangan->perihal }}</td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="text-left">
                        1.	Paket Pengadaan Material/Jasa Uraian material	
                    </div>
                    <div class="table-responsive">                                                
                        <table id="dt_material" class="table table-bordered nowrap w-100">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>URAIAN</th>
                                    <th>VOLUME</th>
                                    <th>HARGA @</th>
                                    <th>SATUAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @forelse ($material as $m)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $m->uraian }}</td>
                                        <td>{{ $m->volume }}</td>
                                        <td>{{ number_format($m->harga_satuan,2,',','.') }}</td>
                                        <td>{{ $m->satuan }}</td>
                                    </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        <table>
                            <tbody>
                                <tr>
                                    <td>Niai total</td>
                                    <td>:</td>
                                    <td class="float-end">{{ number_format($show->hps,2,',','.') }} ({{ $show->terbilang }})</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="text-left">
                        2.	Pelaksanaan Pengadaan
                    </div>           
                        <table class="w-100">
                        <tbody>
                            <tr>
                                <td>Tempat dan alamat</td>
                                <td>:</td>
                                <td>Kantor Desa {{ $show->desa->nama }}  {{ $show->desa->alamat }} </td>
                            </tr>
                        </tbody>
                    </table>     
                    <div class="">
                        Saudara diminta untuk memasukkan penawaran, teknis dan harga secara langsung sesuai dengan jadwal pelaksanaan sebagai berikut:
                    </div>              
                    <div class="table-responsive">                                                
                        <table id="dt_material" class="table table-bordered nowrap w-100">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>URAIAN</th>
                                    <th>VOLUME</th>
                                    <th>SATUAN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>   
                            </tbody>
                        </table>
                    </div>      
                    <div class="mt-2">
                        ApabilaSaudara memerlukan keterangan dan penjelasan lebih lanjut, dapat menghubungi Tim Pengelola Kegiatan (TPK) Desa {{ $show->desa->nama }}. sesuai alamat tersebut diatas sampai dengan batas akhir pemasukan Dokumen Penawaran.
                        <br>Demikian disampaikan untuk diketahui.
                    </div>   
                    <div class="float-end">
                        Untuk dan atas nama TPK Ketua, <br>
                       <span class="text-center"> {{ $show->aparatur->nama }} </span>
                    </div>         
                    <div class="mt-5 text-small">
                        Akhir Pendaftaran, <br>
                       <span class="text-center"> {!! $show->TanggalSelesaiAt !!} </span>
                    </div>         
                    <hr>                     
                    <form action="{{ route('admin.undangan.paket.konfirmasi.post', $show->id) }}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <input type="hidden" name="paket_id" value="{{ $show->id }}">
                            <input type="hidden" name="undangan_id" value="{{ $undangan->undangan_id }}">
                            <input type="hidden" name="vendor_id" value="{{ $undangan->vendor_id }}">
                            <button name="submit" value="2" class="btn btn-success width-md waves-effect waves-light float-start">
                                <i class="fe-arrow-left"></i> IKUT TENDER 
                            </button>
                            <button name="submit" value="1" class="btn btn-danger width-md waves-effect waves-light float-end">
                                <i class="fe-arrow-left"></i> TOLAK TENDER 
                            </button>
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
