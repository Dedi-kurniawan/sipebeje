<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorRequest extends FormRequest
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
        $id = isset($this->operator) ? $this->operator : '';
        return [
            'email'  => 'required|unique:users,email,'.$id,
            'desa_id'  => 'required',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ];
    }
}
