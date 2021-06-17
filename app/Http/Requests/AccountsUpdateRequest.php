<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountsUpdateRequest extends FormRequest
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
            'agency' => 'required|numeric|digits:4',
            'number' => 'required|numeric|digits:6',
            'digit' => 'required|numeric|digits:1',
            'company_name' => 'max:255',
            'trading_name' => 'max:255',
            'cnpj' => 'numeric|digits:14|',
            'name' => 'numeric|digits:14|',
            'cpf' => 'numeric|digits:11',
            'name' => 'max:255',
            'user_id' => 'required|numeric',
            'account_type_id' => 'required|numeric',
        ];
    }
}
