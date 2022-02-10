<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UndanganVendorRequest extends FormRequest
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
            'undangan_id' => 'required',
            'vendor_id'   => [
                'required', 
                Rule::unique('undangan_vendor')
                    ->where('undangan_id', $this->undangan_id)
                    ->where('vendor_id', $this->vendor_id),
               ]
        ];
    }

    public function messages()
    {
        return [
            'vendor_id.unique'  => 'Vendor sudah ada',
        ];        
    }
}
