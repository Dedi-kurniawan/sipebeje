<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>STEP PERTAMA</title>
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
        .page-break {
            page-break-after: always;
        }
        .f-12 {
            font-size: 12px;
        }
        .table-bordered{
            width: 100%;
            border: 1px solid black;
            border-collapse: collapse;
        }
        .table-bordered tr td{
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
                            <div class="text-bold"> KECAMATAN {{ $paket->kecamatan->nama }} </div>
                            <div> DESA {{ $paket->desa->nama }} </div>
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
        <div class="text-center">
            <span class="text-bold">HARGA PERKIRAAN SENDIRI (HPS)</span><br>
            <span class="text-bold text-uppercase">KEGIATAN {{ $paket->akk->kegiatan }} <br>
                DUSUN {{ $paket->akk->dusun }} RT {{ $paket->akk->rt }}
            </span>
        </div>
        <br>
        <table class="table-bordered">
            <tr>
                <td>NO</td>
                <td>URAIAN</td>
                <td>VOLUME</td>
                <td>SATUAN</td>
                <td>HARGA SATUAN</td>                
                <td>JUMLAH</td>
                <td>PAJAK</td>
                <td>TOTAL (Jumlah + Pajak)</td>
                
            </tr>
            @php
                $total = 0; 
            @endphp
            @foreach($paket->hpsTable as $hps)
            @php
                 $total += ($hps->jumlah + $hps->harga_pajak); 
            @endphp
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $hps->uraian }}</td>
                    <td>{{ $hps->volume }}</td>
                    <td>{{ $hps->satuan }}</td>
                    <td>{{ number_format($hps->harga_satuan,2,',','.') }}</td>
                    <td>{{ number_format($hps->jumlah,2,',','.') }}</td>
                    <td>{{ $hps->pajak }} %</td>
                    <td>{{ number_format($hps->jumlah + $hps->harga_pajak,2,',','.') }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6" class="text-bold">TOTAL</td>
                <td colspan="2">Rp {{ number_format($total,2,',','.') }}</td>
            </tr>
        </table>
    </div>
    <br>
    <div style="float: right;">
        <table>
            <tr>
                <td>Bengkulu Utara, {{ $paket->akk->CreatedAtFormat }}</td>
            </tr>
            <tr>
                <td>PELAKSANA KEGIATAN</td>
            </tr>
            {{-- <tr>
                    <td class="text-center">{{ ucwords(strtolower($paket->aparatur->jabatan)) }}</td>
            </tr> --}}
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="text-center">{{ ucwords(strtolower($paket->aparatur->nama)) }}</td>
            </tr>
        </table>
    </div>
</body>
</html>
