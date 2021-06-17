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
            'company_name' => 'max:255',
            'trading_name' => 'max:255',
            'cnpj' => 'numeric|digits:14|unique:accounts',
            'name' => 'numeric|digits:14|unique:accounts',
            'cpf' => 'unique:accounts|numeric|digits:11',
            'name' => 'max:255',
            'user_id' => 'required|numeric',
            'account_type_id' => 'required|numeric',

        ];
    }
}
