<?php

namespace App\Http\Request\Company;

use Illuminate\Foundation\Http\FormRequest;

class ContractRequest extends FormRequest
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
    public function messages()
    {
        return [
            'name.required' => 'Favor informar o nome do contrato',
            'template.required' => 'Favor informar template do contrato'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $validator = [
            'name' => 'required',
            'template' => 'required'
        ];

        return $validator;
    }

}
