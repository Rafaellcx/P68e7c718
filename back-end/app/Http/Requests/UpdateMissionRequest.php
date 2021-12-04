<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMissionRequest extends FormRequest
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
            'user_id' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'id.required' => 'Id não informado.',
            'name.required' => 'Nome não informado.',
            'user_id.required' => 'Id do usuário não informado.'
        ];
    }
}
