<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BERITA ACARA SERAH TERIMA BARANG</title>
    <style>
        body {
            font-family: "Arial Narrow", Times, serif;
            /* font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;  */
            font-size: 12px;
            margin: 0cm 2cm 2cm 2cm;
        }

        .kop-surat {
            text-align: center;
        }

        .lineup {
            border-bottom: 3px solid black;
            margin-top: 1px;
        }

        .linebottom {
            border-bottom: 1px solid black;
            margin-top: 1px;
        }

        .title-one {
            font-size: 16px;
            margin-bottom: 0.5px;
        }

        .title-two {
            text-align: center;
            font-size: 16px;
        }

        .text-uppercase {
            text-transform: uppercase;
        }

        .text-bold {
            font-weight: bold;
        }

        .text-right {
            text-align: right;
        }

        .text-left {
            text-align: left;
        }

        .text-center {
            text-align: center;
        }

        .table-material table,
        .table-border {
            border: 1px solid black;
            border-collapse: collapse;
        }

        .page-break {
            page-break-after: always;
        }

        .f-12 {
            font-size: 12px;
        }
        .f-14 {
            font-size: 14px;
        }
        .table-bordered {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-bordered tr td {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
<div class="akk text-uppercase">
    <table width="100%">
        <tr>
            <td>
                <img alt="Logo" src="{{ asset('template/images/logo/logo-sm.png') }}" class="text-right" align="bottom" width="70" height="80" />
            </td>
            <td class="text-center text-bold">
                <div class="kop-surat">
                    <div>DESA {{ strtoupper($ba->nama_desa) }} </div>
                    <div class="text-bold">KECAMATAN {{ strtoupper($ba->kecamatan) }}</div>
                    <div>{{ $ba->alamat_desa }}</div>
                </div>
            </td>
        </tr>
    </table>
    <div class="kop-surat">
        <div class="lineup"></div>
        <div class="linebottom"></div>
    </div>
</div>
<br>
<div class="text-center f-12">
    <strong><u>BERITA ACARA SERAH TERIMA BARANG</u></strong><br/>
    <strong>Nomor: {{ $ba->nomor_surat }}</strong>
</div>
<p>{{ $ba->tanggal_text }}, kami yang bertanda tangan dibawah ini :</p>
<table style="margin-left: -2px">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><strong>{{ $ba->pihak_1 }}</strong></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>Desa {{ ucwords(strtolower($ba->nama_desa)) }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>Ketua Tim Pengelola Kegiatan (TPK)</td>
    </tr>
</table>
<table>
    <tr>
        <td>selanjutnya disebut sebagai KETUA TPK</td>
    </tr>
</table>
<br>
<table style="margin-left: -2px">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><strong>{{ strtoupper($ba->pihak_2) }}</strong></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>Desa {{ ucwords(strtolower($ba->nama_desa)) }}</td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>Pengurus Barang pada Desa {{ ucwords(strtolower($ba->nama_desa)) }} Kecamatan Batiknau  Kabupaten Bengkulu Utara</td>
    </tr>
</table>
<table>
    <tr>
        <td>Selanjutnya disebut sebagai PIHAK KEDUA</td>
    </tr>
</table>
<p>
    Menyatakan bahwa : <br>
    1. PIHAK PERTAMA telah menyerahkan barang kepada PIHAK KEDUA dan selanjutnya; <br>
    2. PIHAK KEDUA menerima dari PIHAK PERTAMA berupa barang sebagai mana tertuang pada Nota Barang Nomor : {{ $ba->nomor_surat }} Tanggal {{ $ba['tanggal'] }} dengan rincian sebagai berikut :
</p>
<div class="f-11">
    <table class="table-bordered">
        <tr class="text-center">
            <td>No</td>
            <td>JENIS BARANG</td>
            <td>KUALITAS</td>
            <td>Harga satuan (Rp)</td>
            <td>Total  Harga  (Rp)</td>
        </tr>
        @php $total = 0 @endphp
        @foreach ($details as $key => $x)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ ucwords(strtolower($x->uraian)) }}</td>
                <td class="text-right">{{ $x->volume }} {{ $x->satuan }}</td>
                <td class="text-right">{{ number_format($x->harga_satuan, 2)  }}</td>
                <td class="text-right">{{ number_format($x->volume * $x->harga_satuan, 2)  }}</td>
            </tr>
        @php $total += ($x->volume * $x->harga_satuan) @endphp
        @endforeach
        <tr>
            <td colspan="4" class="text-center">Total</td>
            @php
                $total = $total;

                if($ba->ppn > 0) {
                    $total + ($total * $ba->ppn) / 100;
                }
            @endphp
            <td class="text-right">{{ number_format($total, 2) }}</td>
        </tr>
    </table>
    <span style="font-style:italic;">
        Keterangan : Harga Total sudah termasuk pajak, dll
    </span>
</div>
<br>
{{-- <p>Alamat pengiriman barang pada Kantor Desa {{ ucwords(strtolower($ba->nama_desa)) }}</p> --}}
<table style="width:100%">
    <tr>
        <td class="text-center" style="width: 50%">
            <p>
                &nbsp;<br>
                PIHAK PERTAMA
                <br> Ketua Tim Pengelola Kegiatan
            </p>
        </td>
        <td class="text-center" style="width: 50%">
            <p>
                <span>{{ ucwords(strtolower($ba->nama_desa)) }}, {{ strtoupper($ba->tanggal) }}</span><br>
                PIHAK KEDUA
                <br> Pengurus Barang
            </p>
        </td>
    </tr>
    <tr>
        <td><br><br></td>
        <td><br><br></td>
    </tr>
    <tr>
        <td class="text-center">
            <p>
                <u><strong>{{ strtoupper($ba->pihak_1) }}</strong></u>
            </p>
        </td>
        <td class="text-center">
            <u><strong>{{ strtoupper($ba->pihak_2) }}</strong></u>
        </td>
    </tr>
</table>
</body>
</html>
