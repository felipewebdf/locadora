<?php

namespace App\Http\Request\Client;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name.required' => 'Favor informar o nome do cliente',
            'cnh.required' => 'Favor informar a cnh do cliente',
            'cnh.numeric' => 'Favor informar a cnh válida',
            'description.required' => 'Favor informar o endereço do cliente',
            'district.required' => 'Favor informar o bairro do cliente',
            'city.required' => 'Favor informar a cidade do cliente',
            'uf.required' => 'Favor informar a UF do cliente',
            'cep.required' => 'Favor informar o cep do cliente'
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
            'cnh' => 'required|numeric',
            'description' => 'required',
            'district' => 'required',
            'city' => 'required',
            'uf' => 'required',
            'cep' => 'required'

        ];

        return $validator;
    }


}
