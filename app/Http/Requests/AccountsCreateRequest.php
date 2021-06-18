<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountsCreateRequest extends FormRequest
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
            'agency' => 'required|numeric|unique:accounts|digits:4',
            'number' => 'required|numeric|unique:accounts|digits:6',
            'digit' => 'required|numeric|digits:1',
            'user_id' => 'required|numeric',

        ];
    }
}
