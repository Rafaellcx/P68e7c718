<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'id' => 'required', 
            'name' => 'required', 
            'email' => 'required',
            'password' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'id.required' => 'Id não informado.',
            'name.required' => 'Nome não informado.',
            'email.required' => 'E-mail não informado.',
            'password.required' => 'Senha não informada.'
        ];
    }
}
