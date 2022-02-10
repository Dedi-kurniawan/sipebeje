@extends('layouts.backend.master')
@section('title', $bread['third'])
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
                    <h4 class="header-title">Detail {{ $bread['second'] }}</h4>
                    <table class="table table-bordered table-sm w-100">
                        <tbody>
                            <tr>
                                <td class="text-capitalize">Nama Paket</td>
                                <td>{{ $show->paket->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">HPS</td>
                                <td class="fw-bold">Rp. {{ number_format($show->paket->hps,2,',','.') }} ({{ $show->paket->terbilang }})</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Jenis</td>
                                <td>{{ $show->paket->jenis }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Akhir Pendaftaran</td>
                                <td>{!! $show->paket->TanggalSelesaiAt !!}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Status</td>
                                <td>{!! $show->paket->StatusFormatAt !!}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Kecamatan</td>
                                <td>{{ $show->paket->desa->kecamatan->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Desa</td>
                                <td>{{ $show->paket->desa->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Penannggung Jawab</td>
                                <td>{{ $show->paket->aparatur->nama }} - {{ $show->paket->aparatur->jabatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Pemenang</td>
                                <td>{{ $show->vendor_id == NULL ? "-" : $show->vendor->nama_perusahaan }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Deskripsi</td>
                                <td>{!! $show->paket->keterangan !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-100">
                        <thead class="text-center justify-content-center">
                            <tr>
                                <td colspan="2" class="fw-bold">KERANGKA ACUAN KERJA (KAK)</td>
                            </tr>
                            <tr>
                                <td class="text-uppercase fw-bold" colspan="2">KEGIATAN {{ $show->paket->akk->kegiatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-uppercase fw-bold" colspan="2">DUSUN {{ $show->paket->akk->dusun }} RT {{ $show->paket->akk->rt }}</td>
                            </tr>
                        </thead>
                    <table>                            
                    <table class="table table-bordered table-sm w-100">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-nowrap">I. LATAR BELAKANG</td>
                                <td>{!! $show->paket->akk->latar_belakang !!}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">II.	MAKSUD DAN TUJUAN</td>
                                <td>
                                    Maksud : <br> {!! $show->paket->akk->maksud !!}
                                    <br>
                                    Tujuan : <br> {!! $show->paket->akk->tujuan !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">III. HASIL YANG DIHARAPKAN</td>
                                <td>
                                    {!! $show->paket->akk->hasil !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">IV.	LOKASI KEGIATAN</td>
                                <td>
                                    {!! $show->paket->akk->lokasi_kegiatan !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">V. DASAR PENGANGGARAN</td>
                                <td class="text-uppercase">
                                    {!! $show->paket->akk->dasar_penganggaran !!} NO {{ $show->paket->akk->dp_no }} TGL {{ $show->paket->akk->dp_tgl }} BIDANG {{ $show->paket->akk->dp_bidang }} SUBBIDANG {{ $show->paket->akk->dp_subbidang }} KEGIATAN {{ $show->paket->akk->dp_kegiatan }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">VI.	JANGKA WAKTU PELAKSANAAN</td>
                                <td>
                                    {!! $show->paket->akk->waktu_pelaksanaan !!} HARI
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">VII. GAMBARAN PELAKSANAAN KEGIATAN</td>
                                <td>
                                    {!! $show->paket->akk->gambaran_pelaksanaan !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">VIII. SPESIFIKASI TEKNIS (TERLAMPIR)</td>
                                <td>
                                    {!! $show->paket->akk->spesifikasi_teknis !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">IX.	DAFTAR TENAGA KERJA DARI DESA</td>
                                <td>
                                    {!! $show->paket->akk->tenaga_kerja !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">X. METODE PENGADAAN</td>
                                <td>
                                    {!! $show->paket->akk->metode_pengadaan !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">XI.	PAGU ANGGARAN</td>
                                <td>
                                    Rp. {{ number_format($show->paket->akk->pagu_anggaran_rp,2,',','.') }} ({{ $show->paket->akk->pagu_anggaran_terbilang }})
                                </td>
                            </tr>
                        </tbody>
                    </table> 
                    <table class="w-100">
                        <thead class="text-center justify-content-center">
                            <tr>
                                <td colspan="2" class="fw-bold">HARGA PERKIRAAN KERJA (HPS)</td>
                            </tr>
                        </thead>
                    </table> 
                    <table class="table table-bordered table-sm w-100">
                        <thead>
                            <tr>
                                <th>URAIAN</th>
                                <th>VOLUME</th>
                                <th>HARGA @</th>
                                <th>SATUAN</th>
                                <th>JUMLAH</th>
                                <th>PAJAK</th>
                                <th>HARGA SETELAH PAJAK</th>
                                <th>KETERANGAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($show->paket->hpsTable as $hps)
                                <tr>
                                    <td>{{ $hps->uraian }}</td>
                                    <td>{{ $hps->volume }}</td>
                                    <td>{{ number_format($hps->harga_satuan,2,',','.') }}</td>
                                    <td>{{ $hps->satuan }}</td>
                                    <td>{{ number_format($hps->jumlah,2,',','.') }}</td>
                                    <td>{{ $hps->pajak }} %</td>
                                    <td>{{ number_format($hps->jumlah-$hps->harga_pajak,2,',','.') }}</td>
                                    <td>{{ $hps->keterangan }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>
                    <div class="mb-3">
                        <a href="{{ route('admin.undangan.paket') }}" class="btn btn-primary width-md waves-effect waves-light float-start">
                            <i class="fe-arrow-left"></i> KEMBALI 
                         </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
