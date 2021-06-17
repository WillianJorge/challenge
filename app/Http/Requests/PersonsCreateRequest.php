<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonsCreateRequest extends FormRequest
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
            'cpf' => 'unique:persons|numeric|digits:11',
            'name' => 'max:255',
        ];
    }
}
