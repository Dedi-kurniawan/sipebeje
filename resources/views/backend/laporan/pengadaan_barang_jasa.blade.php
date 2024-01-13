<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>LAPORAN PENGADAAN BARANG JASA PER DESA</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            /* font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
            font-size: 12px; */
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

        .table-bordered {
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }

        .table-bordered tr td {
            border: 1px solid black;
            border-collapse: collapse;
            text-align: center;
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
            <td class="text-center">
                <div class="kop-surat">
                    <div>PEMERINTAH KABUPATEN BENGKULU UTARA </div>
                    <div class="text-bold">LAPORAN PENGADAAN BARANG JASA PER DESA</div>
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
<div class="f-11">
    <table class="table-bordered">
        <tr>
            <td>NO</td>
            <td>NAMA DESA</td>
            <td>PENYEDIA</td>
            <td>NAMA PAKET</td>
            <td>KETUA TPK</td>
            <td>HPS</td>
            <td>NO & TGL SPK</td>
            {{-- <td>NILAI SPK</td>
            <td>SPMK</td> --}}
        </tr>
        @foreach ($data as $key => $x)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ ucwords(strtolower($x['desa'])) }}</td>
                <td>{{ ucwords(strtolower($x['penyedia'])) }}</td>
                <td>{{ ucwords(strtolower($x['nama_paket'])) }}</td>
                <td>{{ $x['ketua'] }}</td>
                <td>{{ number_format($x['hps'],2,',','.') }}</td>
                <td>{{ $x['sp_nomor'] }} & {{ $x['sp_tanggal'] }}</td>
            </tr>
        @endforeach
    </table>
</div>
</body>
</html>
