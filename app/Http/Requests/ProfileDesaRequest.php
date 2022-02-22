<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileDesaRequest extends FormRequest
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
            'nama'             => 'required|string|max:255',
            'email'            => 'string|email|max:255|nullable',
            'kepala_desa'      => 'required',
            'tahun_berdiri'    => 'required',
            'telepon'          => 'required',
            'pendamping_desa'  => 'required',
            'alamat'           => 'required',
            'logo'             => 'required|image|mimes:jpeg,png,jpg|max:2048|dimensions:min_width=200,min_height=200,max_width=300,max_height=300',
        ];
    }
}
