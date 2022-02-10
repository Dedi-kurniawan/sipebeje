@section('title', 'Beranda')
@extends('layouts.frontend.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">DETAIL PAKET</h4>
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-bordered table-sm w-100">
                        <tbody>
                            <tr>
                                <td class="text-capitalize">Nama Paket</td>
                                <td>{{ $show->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">HPS</td>
                                <td class="fw-bold">Rp. {{ number_format($show->hps,2,',','.') }} ({{ $show->terbilang }})</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Jenis</td>
                                <td>{{ $show->jenis }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Akhir Pendaftaran</td>
                                <td>{!! $show->TanggalSelesaiAt !!}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Status</td>
                                <td>{!! $show->StatusFormatAt !!}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Kecamatan</td>
                                <td>{{ $show->desa->kecamatan->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Desa</td>
                                <td>{{ $show->desa->nama }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Penannggung Jawab</td>
                                <td>{{ $show->aparatur->nama }} - {{ $show->aparatur->jabatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Pemenang</td>
                                <td>{{ $show->vendor_id == NULL ? "-" : $show->vendor->nama_perusahaan }}</td>
                            </tr>
                            <tr>
                                <td class="text-capitalize">Deskripsi</td>
                                <td>{!! $show->keterangan !!}</td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="w-100">
                        <thead class="text-center justify-content-center">
                            <tr>
                                <td colspan="2" class="fw-bold">KERANGKA ACUAN KERJA (KAK)</td>
                            </tr>
                            <tr>
                                <td class="text-uppercase fw-bold" colspan="2">KEGIATAN {{ $show->akk->kegiatan }}</td>
                            </tr>
                            <tr>
                                <td class="text-uppercase fw-bold" colspan="2">DUSUN {{ $show->akk->dusun }} RT {{ $show->akk->rt }}</td>
                            </tr>
                        </thead>
                    <table>                            
                    <table class="table table-bordered table-sm w-100">
                        <tbody>
                            <tr>
                                <td class="fw-bold text-nowrap">I. LATAR BELAKANG</td>
                                <td>{!! $show->akk->latar_belakang !!}</td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">II.	MAKSUD DAN TUJUAN</td>
                                <td>
                                    Maksud : <br> {!! $show->akk->maksud !!}
                                    <br>
                                    Tujuan : <br> {!! $show->akk->tujuan !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">III. HASIL YANG DIHARAPKAN</td>
                                <td>
                                    {!! $show->akk->hasil !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">IV.	LOKASI KEGIATAN</td>
                                <td>
                                    {!! $show->akk->lokasi_kegiatan !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">V. DASAR PENGANGGARAN</td>
                                <td class="text-uppercase">
                                    {!! $show->akk->dasar_penganggaran !!} NO {{ $show->akk->dp_no }} TGL {{ $show->akk->dp_tgl }} BIDANG {{ $show->akk->dp_bidang }} SUBBIDANG {{ $show->akk->dp_subbidang }} KEGIATAN {{ $show->akk->dp_kegiatan }}
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">VI.	JANGKA WAKTU PELAKSANAAN</td>
                                <td>
                                    {!! $show->akk->waktu_pelaksanaan !!} HARI
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">VII. GAMBARAN PELAKSANAAN KEGIATAN</td>
                                <td>
                                    {!! $show->akk->gambaran_pelaksanaan !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">VIII. SPESIFIKASI TEKNIS (TERLAMPIR)</td>
                                <td>
                                    {!! $show->akk->spesifikasi_teknis !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">IX.	DAFTAR TENAGA KERJA DARI DESA</td>
                                <td>
                                    {!! $show->akk->tenaga_kerja !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">X. METODE PENGADAAN</td>
                                <td>
                                    {!! $show->akk->metode_pengadaan !!} 
                                </td>
                            </tr>
                            <tr>
                                <td class="fw-bold text-nowrap">XI.	PAGU ANGGARAN</td>
                                <td>
                                    Rp. {{ number_format($show->akk->pagu_anggaran_rp,2,',','.') }} ({{ $show->akk->pagu_anggaran_terbilang }})
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
</div>
@endsection
