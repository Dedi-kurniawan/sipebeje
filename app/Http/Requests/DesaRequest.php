<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DesaRequest extends FormRequest
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
        $id = isset($this->desa) ? $this->desa : '';
        return [
            'kecamatan_id' => 'required',
            'nama'  => [
                'required', 
                Rule::unique('desa')
                    ->where('kecamatan_id', $this->kecamatan_id)
                    ->ignore($id),
               ]
        ];
    }
}
