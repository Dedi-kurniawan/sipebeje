<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BaBarangRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'vendor'  => 'required',
            'vendor_alamat'  => 'required',
            'vendor_jabatan'  => 'required',
            'aparatur_id'  => 'required',
            'nomor_surat'  => 'required',
            'tanggal'  => 'required',
        ];
    }
}
