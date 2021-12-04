<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'type_user_id' => 'required',
            'name' => 'required', 
            'email' => 'required',
            'password' => 'required'
        ];

    }

    public function messages()
    {
        return [
            'type_user_id.required' => 'Id do Tipo de Usuário não informado.',
            'name.required' => 'Nome não informado.',
            'email.required' => 'E-mail não informado.',
            'password.required' => 'Senha não informada.'
        ];
    }
}
