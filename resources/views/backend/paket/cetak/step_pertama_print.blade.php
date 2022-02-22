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
                    <img alt="Logo" src="{{ $paket->desa->PhotoPath }}" class="text-right" align="bottom" width="70"
                        height="80" />
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
        <br>
        <div class="f-11">
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
                <span style="text-align: justify;">{{ $paket->akk->dasar_penganggaran }} NO
                    {{ $paket->akk->dp_no }}
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

    <div class="akk text-uppercase">
        <table width="100%">
            <tr>
                <td>
                    <img alt="Logo" src="{{ $paket->desa->PhotoPath }}" class="text-right" align="bottom" width="70" height="80" />
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
    <table class="table-bordered">
        <tr>
            <td>NO</td>
            <td>URAIAN</td>
            <td>VOLUME</td>
            <td>SATUAN</td>
        </tr>
        @foreach($paket->hpsTable as $hps)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $hps->uraian }}</td>
            <td>{{ $hps->volume }}</td>
            <td>{{ $hps->satuan }}</td>
        </tr>
        @endforeach
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
