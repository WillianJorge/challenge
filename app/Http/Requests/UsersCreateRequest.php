<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersCreateRequest extends FormRequest
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
            'name' => 'required|max:255',
            'cpf' => 'required|unique:users|numeric|digits:11',
            'phone_number' => 'required|numeric|digits:11',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6'
        ];
    }
}
