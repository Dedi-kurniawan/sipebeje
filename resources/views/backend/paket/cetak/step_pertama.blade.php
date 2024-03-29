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

    </style>
</head>

<body>
    <div class="akk text-uppercase">
        <div class="kop-surat">
            <span class="title-one">PEMERINTAH KABUPATEN BENGKULU UTARA</span><br>
            <span class="title-two text-uppercase">KECAMATAN {{ $paket->kecamatan->nama }} <br> DESA
                {{ $paket->desa->nama }} </span>
            <div class="lineup"></div>
            <div class="linebottom"></div>
        </div>
        <br>
        <div class="text-center">
            <span class="text-bold">KERANGKA ACUAN KERJA (KAK)</span><br>
            <span class="text-bold text-uppercase">KEGIATAN {{ $paket->akk->kegiatan }} <br>
                DUSUN {{ $paket->akk->dusun }} RT {{ $paket->akk->rt }}
            </span>
        </div>
        <br>
        <span class="text-bold">I. LATAR BELAKANG.</span><br>
        <div>
            <span style="text-align: justify;">
                {{ $paket->akk->latar_belakang }}
            </span>
        </div>
        <br>
        <span class="text-bold">II. MAKSUD DAN TUJUAN</span>
        <div>
            <span class="text-bold">Maksud :</span><br>
            <span>{{ $paket->akk->maksud }}</span><br><br>
            <span class="text-bold">Tujuan :</span><br>
            <span>{{ $paket->akk->tujuan }}</span>
        </div>
        <br>
        <span class="text-bold">III. HASIL YANG DIHARAPKAN</span>
        <div>
            <span>{{ $paket->akk->hasil }}</span>
        </div>
        <br>
        <span class="text-bold">IV. LOKASI KEGIATAN</span>
        <div>
            <span style="text-align: justify;">{{ $paket->akk->lokasi_kegiatan }}</span>
        </div>
        <br>
        <span class="text-bold">V. DASAR PENGANGGARAN</span>
        <div>
            <span style="text-align: justify;">{{ $paket->akk->dasar_penganggaran }} NO {{ $paket->akk->dp_no }}
                TGL
                {{ $paket->akk->dp_tgl }} BIDANG {{ $paket->akk->dp_bidang }} SUB BIDANG
                {{ $paket->akk->dp_subbidang }} KEGIATAN {{ $paket->akk->dp_kegiatan }}</span>
        </div>
        <br>
        <span class="text-bold">VI. JANGKA WAKTU PELAKSANAAN</span>
        <div>
            <span style="text-align: justify;">{{ $paket->akk->kegiatan }} YAITU SELAMA
                {{ $paket->akk->waktu_pelaksanaan }} HARI</span>
        </div>
        <br>
        <span class="text-bold">VII. GAMBARAN PELAKSANAAN KEGIATAN</span>
        <div>
            <span style="text-align: justify;">{!! $paket->akk->gambaran_pelaksanaan !!}</span>
        </div>
        <br>
        <span class="text-bold">VIII. SPESIFIKASI TEKNIS (TERLAMPIR)</span>
        <div>
            <span style="text-align: justify;">{!! $paket->akk->spesifikasi_teknis !!}</span>
        </div>
        <br>
        <span class="text-bold">IX. DAFTAR TENAGA KERJA DARI DESA </span>
        <div>
            <span style="text-align: justify;">{!! $paket->akk->tenaga_kerja !!}</span>
        </div>
        <br>
        <span class="text-bold">X. METODE PENGADAAN</span>
        <div>
            <span style="text-align: justify;">{!! $paket->akk->metode_pengadaan !!}</span>
        </div>
        <br>
        <span class="text-bold">XI. PAGU ANGGARAN</span>
        <div>
            <span style="text-align: justify;">{{ $paket->akk->pagu_anggaran }} ADALAH Rp.
                {{ number_format($paket->akk->pagu_anggaran_rp,2,',','.') }}
                ({{ $paket->akk->pagu_anggaran_terbilang }})</span>
        </div>
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
    
    <div class="page-break"></div>
    <div class="hps">
        <div class="kop-surat">
            <span class="title-one">PEMERINTAH KABUPATEN BENGKULU UTARA</span><br>
            <span class="title-two text-uppercase">KECAMATAN {{ $paket->kecamatan->nama }} <br> DESA
                {{ $paket->desa->nama }} </span>
            <div class="lineup"></div>
            <div class="linebottom"></div>
        </div>
        <br><br>
        <div class="table-material">
            <table width="100%">
                <tr>
                    <td class="table-border text-center">NO</td>
                    <td class="table-border text-center">URAIAN</td>
                    <td class="table-border text-center">VOLUME</td>
                    <td class="table-border text-center">HARGA SATUAN</td>
                    <td class="table-border text-center">JUMLAH</td>
                    <td class="table-border text-center">PAJAK</td>
                    <td class="table-border text-center">HARGA SETELAH PAJAK</td>
                    <td class="table-border text-center">KETERANGAN</td>
                </tr>
                @foreach($paket->hpsTable as $hps)
                    <tr>
                        <td class="table-border">{{ $loop->iteration }}</td>
                        <td class="table-border">{{ $hps->uraian }}</td>
                        <td class="table-border">{{ $hps->volume }}</td>
                        <td class="table-border">
                            {{ number_format($hps->harga_satuan,2,',','.') }}
                        </td>
                        <td class="table-border">
                            {{ number_format($hps->jumlah,2,',','.') }}
                        </td>
                        <td class="table-border">{{ $hps->pajak }} %</td>
                        <td class="table-border">
                            {{ number_format($hps->jumlah-$hps->harga_pajak,2,',','.') }}
                        </td>
                        <td class="table-border">{{ $hps->keterangan }}</td>
                    </tr>
                @endforeach
            </table>
        </div>
        <br>
        <div style="float: right;">
            <table>
                <tr>
                    <td>{{ $paket->desa->nama }}, {{ $paket->akk->CreatedAtFormat }}</td>
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
    </div>
</body>

</html>
