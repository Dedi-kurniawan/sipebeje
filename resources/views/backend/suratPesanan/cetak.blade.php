<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SURAT PESANAN</title>
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
                    <div>PEMERINTAH KABUPATEN BENGKULU UTARA </div>
                    <div class="text-bold">KECAMATAN {{ strtoupper($sp->kecamatan) }}</div>
                    <div>{{ $sp->alamat_desa }} - Kabupaten Bengkulu Utara</div>
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
    <strong><u>SURAT PESANAN</u></strong><br/>
    <strong>Nomor: {{ $sp->nomor_surat }}</strong>
</div>
<p>{{ $sp->tanggal_text }}, kami yang bertanda tangan dibawah ini :</p>
<table style="margin-left: -2px">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><strong>{{ $sp->nama_aparatur }}</strong></td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>Ketua Tim Pengelola Kegiatan</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $sp->alamat_aparatur }}</td>
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
        <td><strong>{{ $sp->nama_pimpinan_toko }}</strong></td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td>Pimpinan Toko {{ $sp->nama_vendor }}</td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td>{{ $sp->alamat_vendor }}</td>
    </tr>
</table>
<table>
    <tr>
        <td>selanjutnya disebut sebagai PENYEDIA ;</td>
    </tr>
</table>
<p>
    Untuk mengirimkan Barang dengan memperhatikan ketentuan - ketentuan sebagai Berikut : <br>
    1. Rincian Barang
</p>
<div class="f-11">
    <table class="table-bordered">
        <tr class="text-center">
            <td>No</td>
            <td>Uraian Barang</td>
            <td>Volume</td>
            <td>Satuan</td>
            <td>SP</td>
            <td>Total  Harga  (Rp)</td>
        </tr>
        @php $total = 0 @endphp
        @foreach ($details as $key => $x)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ ucwords(strtolower($x->nama)) }}</td>
                <td class="text-right">{{ $x->qty }}</td>
                <td class="text-center">{{ $x->satuan }}</td>
                <td class="text-right">{{ number_format($x->sp, 2)  }}</td>
                <td class="text-right">{{ number_format($x->qty * $x->sp, 2)  }}</td>
            </tr>
        @php $total += ($x->qty * $x->sp) @endphp
        @endforeach
        @php
            $ppn = 0;
            if($sp->ppn > 0) {
                $ppn = $total + ($total * $sp->ppn) / 100;
            }

            $pph = 0;
            if($sp->pph > 0) {
                $pph = $total + ($total * $sp->pph) / 100;
            }
        @endphp
        <tr>
            <td colspan="5" class="text-center">Jumlah setelah pajak</td>
            <td class="text-right">{{ number_format($total + $ppn + $pph, 2) }}</td>
        </tr>
        <tr>
            <td colspan="5" class="text-center">PPN</td>
            <td class="text-right">
                @if($sp->ppn != 0)
                    {{ $sp->ppn }}%
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-center">PPH. 23</td>
            <td class="text-right">
                @if($sp->pph != 0)
                    {{ $sp->pph }}%
                @endif
            </td>
        </tr>
        <tr>
            <td colspan="5" class="text-center">Jumlah sebelum pajak</td>
            <td class="text-right">{{ number_format($total + $ppn + $pph, 2) }}</td>
        </tr>
    </table>
</div>
<br>
<table style="margin-left: -2px; width: 100%">
    <tr>
        <td>2.</td>
        <td colspan="3">Tanggal barang diterima paling</td>
    </tr>
    <tr>
        <td></td>
        <td>lambat tanggal</td>
        <td style="width: 5px">:</td>
        <td>{{ $sp->tanggal_lambat_text }}</td>
    </tr>
    <tr>
        <td>3.</td>
        <td>Dibebankan Kepada</td>
        <td style="width: 5px">:</td>
        <td>{{ $sp->beban_kepada }}</td>
    </tr>
    <tr>
        <td>4.</td>
        <td>Jenis Belanja</td>
        <td style="width: 5px">:</td>
        <td>{{ $sp->jenis_belanja }}</td>
    </tr>
    <tr>
        <td>5.</td>
        <td>Uraian rincian Jenis Belanja</td>
        <td>:</td>
        <td>{{ $sp->uraian_jenis_belanja }}</td>
    </tr>
    <tr>
        <td>6.</td>
        <td colspan="3">Pembayaran akan dibatalkan apabila barang tersebut tidak sesuai dengan pesanan (order)</td>
    </tr>
    <tr>
        <td>7.</td>
        <td colspan="3">Pembayaran dilakukan setelah barang diterima dengan jumlah yang cukup dan dalam  keadaan baik</td>
    </tr>
    <tr>
        <td>8.</td>
        <td colspan="3">
            Pesanan/Order akan batal  bila pada tanggal yang ditentukan melewati batas waktu yang ditentukan <br>
        </td>
    </tr>
    <tr>
        <td></td>
        <td colspan="3">Alamat pengiriman barang pada Kantor Desa {{ ucwords(strtolower($sp->nama_desa)) }}
        </td>
    </tr>
</table>
{{-- <p>Alamat pengiriman barang pada Kantor Desa {{ ucwords(strtolower($sp->nama_desa)) }}</p> --}}
<table style="width:100%">
    <tr>
        <td class="text-center" style="width: 50%">
            <p>
                &nbsp;<br>
                <strong>Menerima Pesanan</strong> <br>
                Toko Fernando II
            </p>
        </td>
        <td class="text-center" style="width: 50%">
            <p>
                <span>{{ ucwords(strtolower($sp->nama_desa)) }}, {{ strtoupper($sp->tanggal) }}</span><br>
                <strong>Untuk dan atas nama Ketua</strong> <br>
                Tim Pengelola Kegiatan
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
                <strong><u>{{ strtoupper($sp->nama_pimpinan_toko) }}</u></strong><br/>
                Pimpinan Toko
            </p>
        </td>
        <td class="text-center">
            <strong>{{ strtoupper($sp->nama_aparatur) }}</strong><br/>&nbsp;
        </td>
    </tr>
</table>
</body>
</html>
