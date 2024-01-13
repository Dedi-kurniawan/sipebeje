<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>BERITA ACARA SERAH TERIMA HASIL PEKERJAAN</title>
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
                    <img alt="Logo" src="{{ asset('template/images/logo/logo-sm.png') }}"
                        class="text-right" align="bottom" width="70" height="80" />
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
        <strong><u>BERITA ACARA SERAH TERIMA HASIL PEKERJAAN</u></strong><br />
        <strong>Nomor: {{ $ba->nomor_surat }}</strong>
    </div>
    <p>{{ $ba->tanggal_text }}, kami yang bertanda tangan dibawah ini :</p>
    <table style="margin-left: -2px">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><strong>{{ $ba->kepala_desa }}</strong></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $ba->alamat_kepala_desa }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>Kepala Desa</td>
        </tr>
    </table>
    <table>
        <tr>
            <td>selanjutnya disebut sebagai PIHAK PERTAMA</td>
        </tr>
    </table>
    <br>
    <table style="margin-left: -2px">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><strong>{{ strtoupper($ba->nama_aparatur) }}</strong></td>
        </tr>
        <tr>
            <td>Alamat</td>
            <td>:</td>
            <td>{{ $ba->alamat_aparatur }}</td>
        </tr>
        <tr>
            <td>Jabatan</td>
            <td>:</td>
            <td>Ketua Tim Pengelola Kegiatan (TPK)</td>
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
        2. PIHAK KEDUA menerima dari PIHAK PERTAMA berupa barang sebagai mana tertuang pada Nota Barang Nomor :
        {{ $ba->nomor_surat }} Tanggal {{ $ba['tanggal'] }} dengan rincian sebagai berikut :
    </p>
    <div class="f-11">
        <table class="table-bordered">
            <tr class="text-center">
                <td rowspan="2">No</td>
                <td rowspan="2">Uraian Barang</td>
                <td rowspan="2">Volume</td>
                <td colspan="2">Cheklist</td>
                <td rowspan="2">Keterangan</td>
            </tr>
            <tr class="text-center">
                <td>Ada</td>
                <td>Tidak Ada</td>
            </tr>
            @php $total = 0 @endphp
                @foreach($details as $key => $x)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ ucwords(strtolower($x->nama)) }}</td>
                        <td class="text-right">{{ $x->qty }} {{ $x->satuan }}</td>
                        <td class="text-right">@if($x->checklist == 'Ada') V @endif</td>
                        <td class="text-right">@if($x->checklist == 'Tidak Ada') V @endif</td>
                        <td class="text-right">{{ $x->keterangan }}</td>
                    </tr>
                @endforeach
        </table>
    </div>
    <br>
    <p>Demikian Berita Acara Serah Terima Hasil Pekerjaan ini dibuat dengan sebenarnya dan dipergunakan sebagaimana mestinya.</p>
    <table style="width:100%">
        <tr>
            <td class="text-center" style="width: 50%">
                <p>
                    &nbsp;<br>
                    PIHAK PERTAMA
                    <br> KEPALA DESA
                </p>
            </td>
            <td class="text-center" style="width: 50%">
                <p>
                    <span>{{ ucwords(strtolower($ba->nama_desa)) }}, {{ strtoupper($ba->tanggal) }}</span><br>
                    PIHAK KEDUA
                    <br> Untuk dan Atas Nama TPK
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
                    <u><strong>{{ strtoupper($ba->kepala_desa) }}</strong></u>
                </p>
            </td>
            <td class="text-center">
                <u><strong>{{ strtoupper($ba->nama_aparatur) }}</strong></u>
            </td>
        </tr>
    </table>
</body>

</html>
