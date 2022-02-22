<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SURAT UNDANGAN</title>
    <style>
       body {
            font-family: "Times New Roman", Times, serif;
            /* font-family: "Helvetica Neue", Helvetica, Arial, sans-serif; 
            font-size: 12px; */
            margin: 0cm 1cm 1cm 1cm;
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

        .table-material {
            margin-left: 19px;
        }

        .table-material table,
        .table-border {
            border: 1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>

<body>
    <div class="kop-surat">
        <span class="title-one text-bold">TIM PENGELOLA KEGIATAN</span><br>
        <span class="title-two text-uppercase text-bold">DESA {{ $undanganVendor->paket->desa->nama }} KECAMATAN
            {{ $undanganVendor->paket->kecamatan->nama }}</span>
        <div class="lineup"></div>
        <div class="linebottom"></div>
    </div>
    <p class="text-right">{{ $undanganVendor->CreatedFormatAt }}</p>
    <span class="text-left">Nomor <span style="margin-left: 18px;">:</span>
        {{ $undanganVendor->undangan->nomor }}</span><br>
    <span class="text-left">Lampiran <span>:</span> 1 (satu) dokumen</span>
    <br><br>
    <span>Kepada Yth.</span>
    <br>
    <span>Pimpinan Penyedia {{ $undanganVendor->vendor->nama_perusahaan }}</span>
    <br>
    <span>Di {{ $undanganVendor->vendor->alamat }}</span>
    <p>Perihal <span style="margin-left: 18px;">:</span> {{ $undanganVendor->undangan->perihal }}</p>
    <span>1. Paket Pengadaan Material/Jasa</span>
    <br>
    <span>&nbsp;&nbsp;&nbsp; Uraian material</span>
    <div class="table-material">
        <table width="100%">
            <tr>
                <td class="table-border text-center">NO</td>
                <td class="table-border text-center">URAIAN</td>
                <td class="table-border text-center">VOLUME</td>
                <td class="table-border text-center">SATUAN</td>
            </tr>
            @forelse($paket->hpsTable as $hps)
            <tr>
                <td class="table-border text-center">{{ $loop->iteration }}</td>
                <td class="table-border">{{ $hps->uraian }}</td>
                <td class="table-border text-center">{{ $hps->volume }}</td>
                <td class="table-border text-center">{{ $hps->satuan }}</td>
            </tr>
            @empty
                <tr>
                    <td colspan="4"></td>
                </tr>
            @endforelse
        </table>
    </div>
    <span style="margin-left: 18px;">Nilai total <span style="margin-left: 18px;">:</span> Rp.
        {{ number_format($paket->hps,2,',','.') }}
        ({{ $paket->terbilang }})</span>
    <br>
    <span style="margin-left: 18px;">Sumber dana <span>:</span> APB Desa Tahun Anggaran
        {{ $undanganVendor->undangan->sumber_dana }}</span>
    <br><br>
    <span>2. Pelaksanaan Pengadaan</span><br>
    <span style="text-transform: capitalize;">&nbsp;&nbsp;&nbsp;&nbsp;Tempat dan alamat : Kantor Desa
        {{ ucwords(strtolower($paket->desa->nama)) }}</span><br>
    <span style="margin-left: 10em;">{{ $paket->desa->alamat }}</span><br>
    <span style="text-transform: capitalize;">&nbsp;&nbsp;&nbsp;&nbsp;Telepon/fax <span style="margin-left: 52px;">:</span> {{ ucwords(strtolower($undanganVendor->paket->desa->telepon)) }}</span>
    <p>Saudara diminta untuk memasukkan penawaran, teknis dan harga secara langsung sesuai dengan jadwal pelaksanaan sebagai berikut :</p>
    <div class="table-material">
        <table width="100%">
            <tr>
                <td class="table-border text-center">NO</td>
                <td class="table-border text-center">URAIAN</td>
                <td class="table-border text-center">VOLUME</td>
                <td class="table-border text-center">SATUAN</td>
            </tr>
            <tr>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
            <tr>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td class="table-border">&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
    </div>
    <p>
        Apabila Saudara memerlukan keterangan dan penjelasan lebih lanjut, dapat menghubungi Tim Pengelola Kegiatan
        (TPK) Desa {{ $undanganVendor->paket->desa->nama }} sesuai alamat tersebut diatas sampai dengan batas
        akhir pemasukan Dokumen Penawaran.
        <br><br>
        Demikian disampaikan untuk diketahui.
    </p>
    <div style="float: right;">
        <table>
            <tr>
                <td>Untuk dan atas nama TPK</td>
            </tr>
            <tr>
                <td class="text-center">Ketua,</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td class="text-center">{{ ucwords(strtolower($undanganVendor->paket->aparatur->nama)) }}</td>
            </tr>
            <tr>
                <td class="text-center">{{ ucwords(strtolower($undanganVendor->paket->aparatur->jabatan)) }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
