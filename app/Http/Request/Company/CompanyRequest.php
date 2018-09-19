<?php

namespace App\Http\Request\Company;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
            'name.required' => 'Favor informar o nome da empresa',
            'cnpj.required' => 'Favor informar o cnpj da empresa',
            'description.required' => 'Favor informar o endereço da empresa',
            'district.required' => 'Favor informar o bairro da empresa',
            'city.required' => 'Favor informar a cidade da empresa',
            'uf.required' => 'Favor informar a UF da empresa',
            'cep.required' => 'Favor informar o cep da empresa'
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
            'cnpj' => 'required',
            'description' => 'required',
            'district' => 'required',
            'city' => 'required',
            'uf' => 'required',
            'cep' => 'required'
        ];

        return $validator;
    }

}
