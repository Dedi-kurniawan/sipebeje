<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AkkRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'kegiatan'             => 'required',
            'dusun'                => 'nullable',
            'rt'                   => 'nullable',
            'latar_belakang'       => 'required',
            'maksud'               => 'required',
            'tujuan'               => 'required',
            'hasil'                => 'required',
            'lokasi_kegiatan'      => 'required',
            // 'dasar_penganggaran'   => 'required',
            // 'dp_no'                => 'required',
            // 'dp_tgl'               => 'required',
            'dp_bidang'            => 'required',
            'dp_subbidang'         => 'required',
            'dp_kegiatan'          => 'required',
            'waktu_pelaksanaan'    => 'required',
            'gambaran_pelaksanaan' => 'required',
            'spesifikasi_teknis'   => 'required',
            'tenaga_kerja'         => 'required',
            'metode_pengadaan'     => 'required',
            // 'pagu_anggaran'        => 'required',
            // 'pagu_anggaran_rp'     => 'required',
            // 'pagu_anggaran_terbilang' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'dp_no.required'      => 'kolom nomor di larang kosong',
            'dp_tgl.required'     => 'kolom tanggal di larang kosong',
            'dp_bidang.required'  => 'kolom bidang di larang kosong',
            'dp_subbidang.required'  => 'kolom sub bidang di larang kosong',
            'dp_kegiatan.required'   => 'kolom kegiatan di larang kosong',
        ];        
    }
}
