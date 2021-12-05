<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLogCommandMissionRequest extends FormRequest
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
            'description' => 'required',
            'mission_id' => 'required',
            'user_id' => 'required',
        ];

    }

    public function messages()
    {
        return [
            'description.required' => 'Comando não informado.',
            'mission_id.required' => 'Id da missão não informada.',
            'user_id.required' => 'Id do usuário não informado.'
        ];
    }
}
