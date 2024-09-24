<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VendorRequest extends FormRequest
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
        $user_id = isset($this->user_id) ? $this->user_id : '';
        $id = isset($this->vendor) ? $this->vendor : '';
        return [
            'name'             => 'required|string|max:255',
            'email'            => 'required|string|email|max:255|unique:users,email,'.$user_id,
            'nama_perusahaan'  => 'required|string|max:255',
            // 'email_perusahaan' => 'nullable|string|email|max:255',
            'kecamatan_id'     => 'required',
            'desa_id'          => 'required',
            'telepon'          => 'required',
            'npwp'             => 'required|string|max:255|unique:vendor,npwp,'.$id,
        ];
    }
}
