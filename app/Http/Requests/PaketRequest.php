<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaketRequest extends FormRequest
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
            'nama'      => 'required',
            'jenis'     => 'required',
            'hps'       => 'nullable',
            'aparatur_id' => 'required',
            'tanggal_selesai' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'aparatur_id.required'  => 'Kolom penanggung jawab di larang kosong',
        ];
    }
}
