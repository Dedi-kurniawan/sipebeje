<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>STEP KEDUA</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            padding-right: 5px;
            padding-bottom: 5px;
            padding-left: 5px;
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
    <div>
        <div class="kop-surat">
            <span class="title-one">TIM PENGELOLA KEGIATAN</span><br>
            <span class="title-two text-uppercase">DESA {{ $paket->desa->nama }} KECAMATAN
                {{ $paket->kecamatan->nama }} </span><br>
            <span>TAHUN ANGGARAN {{ $paket->evaluasiPenawaran->tahun_anggaran }}</span>
            <div class="lineup"></div>
            <div class="linebottom"></div>
        </div>
        <br>
        <div class="text-center">
            <span>BERITA ACARA EVALUASI HARGA</span>
        </div>
        <br>
        <span>Nomor &nbsp;&nbsp;&nbsp;&nbsp;: {{ $paket->evaluasiPenawaran->nomor }}</span><br>
        <span>Kegiatan &nbsp;: {{ $paket->evaluasiPenawaran->kegiatan }}</span>
        <p style="text-align: justify">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{ $paket->evaluasiPenawaran->TanggalFormatAt }},
            dimulai pada pukul {{ $paket->evaluasiPenawaran->jam }} WIB, yang bertanda tangan di bawah ini Tim
            Pengelola Kegiatan (TPK) yang melaksanakan pengadaan barang/jasa di kegiatan Desa
            {{ ucwords(strtolower($paket->desa->nama)) }} yang ditunjuk melalui SK Kepala Desa Nomor
            {{ $paket->evaluasiPenawaran->nomor_sk }} Tahun anggaran
            {{ $paket->evaluasiPenawaran->tahun_anggaran }}, telah mengadakan evaluasi terhadap Penyedia yang telah
            memasukkan dokumen penawaran, dengan hasil perusahaan/penyedia dinyatakan memenuhi syarat, daftar terlampir.
            <br>
        </p>
        <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Demikian berita acara ini kami buat untuk dapat dipergunakan
            sebagaimana mestinya.</p>
    </div>
    <div style="float: right;">
        <table>
            <tr>
                <td>Bengkulu Utara, {{ $paket->evaluasiPenawaran->CreatedAtFormat }}</td>
            </tr>
            <tr>
                <td>Untuk dan atas nama TPK</td>
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
    <div class="table-material">
        <table width="100%">
            <tr>
                <td class="table-border text-center" rowspan="2">No</td>
                <td class="table-border text-center" rowspan="2">Unsur yang dievaluasi</td>
                <td class="table-border text-center">Nama Perusahaan</td>
            </tr>
            <tr>
                <td class="table-border text-center">
                    {{ $paket->vendor_id == NULL ? "-" : $paket->vendor->nama_perusahaan }}
                </td>
            </tr>
            <tr>
                <td class="table-border text-center">A</td>
                <td class="table-border text-center">ADMINISTRASI</td>
                <td class="table-border text-center">MN</td>
            </tr>
            <tr>
                <td class="table-border text-center">&nbsp;&nbsp;1</td>
                <td class="table-border text-center">NPWP</td>
                <td class="table-border text-center">MN</td>
            </tr>
            <tr>
                <td class="table-border text-center">&nbsp;&nbsp;2</td>
                <td class="table-border text-center">Surat Penawaran</td>
                <td class="table-border text-center">MN</td>
            </tr>
            <tr>
                <td class="table-border text-center">B</td>
                <td class="table-border text-center">HARGA</td>
                <td class="table-border text-center">MN</td>
            </tr>
            <tr>
                <td class="table-border text-center">&nbsp;&nbsp;</td>
                <td class="table-border text-center">Kesimpulan</td>
                <td class="table-border text-center">Lulus</td>
            </tr>
        </table>
        <p>
            Catatan: <br>
            MN : Memenuhi<br>
            TM : Tidak Memenuhi

        </p>
    </div>
    <div class="page-break"></div>
    <div class="kop-surat">
        <span class="title-one">TIM PENGELOLA KEGIATAN</span><br>
        <span class="title-two text-uppercase">DESA {{ $paket->desa->nama }} KECAMATAN
            {{ $paket->kecamatan->nama }} </span>
        <div class="lineup"></div>
        <div class="linebottom"></div>
    </div><br><br>
    <div class="text-center">
        <span style="text-decoration: underline;">BERITA ACARA NEGOSIASI HARGA</span><br>
        <span>NOMOR: {{ $paket->negoHarga->nomor }}</span>
    </div>
    <br><br>
    <table width="100%">
        <tr>
            <td colspan="2">{{ $paket->negoHarga->TanggalFormatAt }}, dimulai pada pukul {{ $paket->negoHarga->jam }} WIB, yang bertanda tangan di bawah ini Tim Pengelola Kegiatan (TPK) telah mengadakan negosiasi harga terhadap Surat Penawaran yang sah yang diajukan oleh rekanan.</td>
        </tr>
        <tr>
            <td colspan="2">I. Uraian Klarifikasi mengenai:</td>
        </tr>
        <tr>
            <td style="width: 10px">&nbsp;</td>
            <td>{!! $paket->negoHarga->uraian_klarifikasi !!}</td>
        </tr>
        <tr>
            <td colspan="2">II. Uraian negosiasi:</td>
        </tr>
        <tr>
            <td style="width: 10px">&nbsp;</td>
            <td>Dari penawaran yang diajukan oleh rekanan sebesar Rp. {{ number_format($paket->negoHarga->penawaran_rekanan,2,',','.') }} ({{ $paket->negoHarga->penawaran_rekanan_terbilang }}) berdasarkan Pengadaan Desa TPK menetapkan dan menerima penawaran yang diajukan oleh rekanan sebesar Rp. {{ number_format($paket->negoHarga->penawaran_diajukan,2,',','.') }} ({{ $paket->negoHarga->penawaran_diajukan_terbilang }}) dan pihak Rekanan dapat menerima dan menyetujui hasil negosiasi tersebut.</td>
        </tr>
        <tr>
            <td colspan="2">III. Kesimpulan:</td>
        </tr>
    </table>
    <div class="table-material" style="margin-left: 1.5em">
        <table width="100%">
            <tr>
                <td class="table-border text-center" rowspan="2">No</td>
                <td class="table-border text-center" rowspan="2">Nama Penyedia</td>
                <td class="table-border text-center" rowspan="2">Hasil Negosiasi (Rp)</td>
                <td class="table-border text-center" colspan="3">Hasil Evaluasi</td>
            </tr>
            <tr>
                <td class="table-border text-center">ADM</td>
                <td class="table-border text-center">Harga</td>
                <td class="table-border text-center">Hasil Akhir</td>
            </tr>
            <tr>
                <td class="table-border text-center">1</td>
                <td class="table-border text-center">
                    {{ $paket->vendor_id == NULL ? "-" : $paket->vendor->nama_perusahaan }}
                </td>
                <td class="table-border text-center text-uppercase">
                    {{ number_format($paket->negoHarga->hasil_nego,2,',','.') }}
                </td>
                <td class="table-border text-center text-uppercase">{{ $paket->negoHarga->administrasi }}</td>
                <td class="table-border text-center text-uppercase">{{ $paket->negoHarga->harga }}</td>
                <td class="table-border text-center text-uppercase">{{ $paket->negoHarga->hasil_akhir }}</td>
            </tr>
        </table>
    </div>
    
    <table width="100%">
         <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">IV.</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Berdasarkan hasil evaluasi di atas, TPK berkesimpulan memutuskan untuk menetapkan perusahan/rekanan tersebut sebagai Penyedia.
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Nama Penyedia
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ $paket->vendor_id == NULL ? "-" : $paket->vendor->nama_perusahaan }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
               Alamat
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ $paket->vendor_id == NULL ? "-" : $paket->vendor->alamat }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                NPWP
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ $paket->vendor_id == NULL ? "-" : $paket->vendor->npwp }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Harga
            </td>
            <td style="text-align:left;vertical-align:top;">
                : Rp. {{ number_format($paket->negoHarga->harga_final,2,',','.') }}
            </td>
        </tr>
    </table>
    <p>Demikian berita acara negosiasi harga ini dibuat dengan penuh tanggung jawab untuk dipergunakan sebagaimana mestinya.</p>
    <table width="100%" class="text-center">
        <tr>
            <td rowspan="2">Penyedia</td>
        </tr>
        <tr>
            <td>Bengkulu Utara, tanggal tsb.diatas <br>Untuk dan atas nama TPK</td>
            <td></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>{{ $paket->vendor_id == NULL ? "-" : $paket->vendor->nama_perusahaan }}</td>
            <td class="text-center">{{ ucwords(strtolower($paket->aparatur->nama)) }}</td>
        </tr>
    </table>
    <div class="page-break"></div>
    <div class="text-center">
        <span>SURAT PERJANJIAN</span><br>
        <span class="text-center">Nomor : {{ $paket->suratPerjanjian->nomor }}</span><br><br>
    </div>
        <p>{{ $paket->evaluasiPenawaran->TanggalFormatAt }} bertempat di {{ $paket->evaluasiPenawaran->tempat }}, kami yang bertandatangan dibawah ini :</p>
    </div>
    <table width="100%" class="text-center">
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">I.</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Nama
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ ucwords(strtolower($paket->aparatur->nama)) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Jabatan
            </td>
            <td style="text-align:left;vertical-align:top;">
                : Pelaksana kegiatan {{ ucwords(strtolower($paket->aparatur->jabatan)) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                &nbsp;
            </td>
            <td style="text-align:left;vertical-align:top;">
                &nbsp;&nbsp;{{ ucwords(strtolower($paket->kecamatan->nama)) }} Kabupaten Bengkulu Utara
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Alamat
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ ucwords(strtolower($paket->desa->alamat)) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">Selanjunya disebut PIHAK PERTAMA</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">II.</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Nama
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ ucwords(strtolower($paket->vendor->user->name)) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Jabatan
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ ucwords(strtolower($paket->vendor->nama_perusahaan)) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;width: 150px;">
                Alamat
            </td>
            <td style="text-align:left;vertical-align:top;">
                : {{ ucwords(strtolower($paket->vendor->alamat)) }}
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">&nbsp;</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">Selanjutnya disebut PIHAK KEDUA</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:left;vertical-align:top;">PIHAK PERTAMA dan PIHAK KEDUA untuk selanjutnya, disebut PARA PIHAK.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:left;vertical-align:top;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bahwa PARA PIHAK telah sepakat dan setuju untuk mengadakan
                perjanjian, dengan ketentuan sebagai berikut:
            </td>
        </tr>
        <tr>
            <td colspan="3">Pasal 1</td>
        </tr>
        <tr>
            <td colspan="3">RUANG LINGKUP PEKERJAAN</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">Ruang lingkup pekerjaan dalam perjanjian ini adalah {{ $paket->suratPerjanjian->ruang_lingkap }}</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Pasal 2</td>
        </tr>
        <tr>
            <td colspan="3">NILAI PEKERJAAN</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">Nilai pekerjaan yang disepakati untuk penyelesaian pekerjaan dalam perjanjian ini adalah sebesar Rp. {{ number_format($paket->suratPerjanjian->harga_final,2,',','.') }} ({{ $paket->suratPerjanjian->harga_final_terbilang }}) termasuk pajak dan bea materai.</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Pasal 3</td>
        </tr>
        <tr>
            <td colspan="3">HAK DAN KEWAJIBAN</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">(1)</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                PIHAK  PERTAMA  berhak  menerima  hasil  pekerjaan  tepat  pada waktunya.
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">(2)</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                PIHAK PERTAMA berkewajiban membayar biaya penyelesaian pekerjaan sebagaimana dimaksud dalam Pasal 2.
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">(3)</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                PIHAK KEDUA berhak atas pembayaran untuk penyelesaian pekerjaan sebagaimana dimaksud dalam Pasal 2.
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">(4)</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                PIHAK KEDUA berkewajiban menyerahkan hasil pekerjaan tepat pada waktunya.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Pasal 4</td>
        </tr>
        <tr>
            <td colspan="3">JANGKA WAKTU PELAKSANAAN PEKERJAAN</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">
                Jangka waktu untuk menyelesaikan pekerjaan adalah {{ $paket->suratPerjanjian->jangka_waktu }} hari kerja mulai tanggal {{ $paket->suratPerjanjian->MulaiFormatAt }} sampai dengan tanggal {{ $paket->suratPerjanjian->SelesaiFormatAt }} sehingga pekerjaan harus selesai dan diserahkan pada tanggal {{ $paket->suratPerjanjian->DiserahkanFormatAt }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Pasal 5</td>
        </tr>
        <tr>
            <td colspan="3">FORCE MAJEURE</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">
                Jangka waktu untuk menyelesaikan pekerjaan adalah {{ $paket->suratPerjanjian->jangka_waktu }} hari kerja mulai tanggal {{ $paket->suratPerjanjian->MulaiFormatAt }} sampai dengan tanggal {{ $paket->suratPerjanjian->SelesaiFormatAt }} sehingga pekerjaan harus selesai dan diserahkan pada tanggal {{ $paket->suratPerjanjian->DiserahkanFormatAt }}
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">(1)</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Yang dimaksud dengan force majeure adalah suatu keadaan yang terjadi diluar kemampuan PARA PIHAK yang tidak dapat diperhitungkan sebelumnya.
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">(2)</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Apabila terjadi keadaan force majeure sebagaimana dimaksud pada ayat (1) maka PARA PIHAK terbebas dari kewajiban yang harus dilaksanakan.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Pasal 6</td>
        </tr>
        <tr>
            <td colspan="3">SANKSI</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">
                Apabila  penyelesaian  pekerjaan  melebihi  batas  waktu  yang  disepakati maka PIHAK KEDUA dikenakan sanksi berupa:
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">1</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Sanksi administratif, berupa peringatan/teguran tertulis;
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">2</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Membayar denda sebesar {{ $paket->suratPerjanjian->persen_denda }} % dari nilai pekerjaan dengan nominal sebesar Rp. {{ number_format($paket->suratPerjanjian->nominal_denda,2,',','.') }} ({{ $paket->suratPerjanjian->nominal_denda_terbilang }});
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">3</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Gugatan secara perdata;
            </td>
        </tr>
        <tr>
            <td style="text-align:left;vertical-align:top;width: 10px;">4</td>
            <td style="text-align:left;vertical-align:top;" colspan="2">
                Pelaporan secara pidana kepada pihak yang berwenang.
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3">Pasal 7</td>
        </tr>
        <tr>
            <td colspan="3">KETENTUAN PENUTUP</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align: justify;">
                Perjanjian ini dibuat rangkap 5 (lima), dua diantaranya bermaterai cukup dan mempunyai kekuatan hukum yang sama untuk dipertanggungjawabkan sesuai peraturan perundang-undangan yang berlaku.
            </td>
        </tr>
    </table>
    <table width="100%" class="text-center">
        <tr>
            <td rowspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td>Bengkulu Utara, {{ $paket->suratPerjanjian->CreatedFormatAt }}</td>
            <td></td>
        </tr>
        <tr>
            <td>PIHAK KEDUA</td>
            <td>PIHAK PERTAMA</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>{{ $paket->vendor_id == NULL ? "-" : $paket->vendor->nama_perusahaan }}</td>
            <td class="text-center">{{ ucwords(strtolower($paket->aparatur->nama)) }}</td>
        </tr>
    </table>
</body>

</html>
