<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileVendorRequest extends FormRequest
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
            'nama_perusahaan'  => 'required|string|max:255',
            'email_perusahaan' => 'required|string|email|max:255',
            'kecamatan_id'     => 'required',
            'desa_id'          => 'required',
            'telepon'          => 'required',
        ];
    }
}
