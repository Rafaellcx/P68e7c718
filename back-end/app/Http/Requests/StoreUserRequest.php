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
            'name' => ['required', 'max:100'],
            'email' => ['required', 'unique:user', 'max:100'],
            'password' => ['required', 'max:200'],
        ];

    }

    public function messages()
    {
        return [
            'type_user_id.required' => 'Id do Tipo de Usuário não informado.',
            'name.required' => 'Nome não informado.',
            'name.max' => 'Nome não pode ter mais que 100 caracteres.',
            'email.unique' => 'E-mail deve ser único.',
            'email.required' => 'E-mail não informado.',
            'email.max' => 'E-mail não pode ter mais que 100 caracteres.',
            'password.required' => 'Senha não informada.',
            'password.max' => 'Senha não pode ter mais que 200 caracteres.'
        ];
    }
}
