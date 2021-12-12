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
            'name' => ['required', 'max:100'], 
            'email' => ['required', 'unique'],
            'email' => ['required', 'unique:user,email,'.$this->id, 'max:100'],
        ];

    }

    public function messages()
    {
        return [
            'name.required' => 'Nome não informado.',
            'name.max' => 'Nome não pode ter mais que 100 caracteres.',
            'email.required' => 'E-mail não informado.',
            'email.unique' => 'E-mail deve ser único.',
            'email.max' => 'E-mail não pode ter mais que 100 caracteres.',
        ];
    }
}
