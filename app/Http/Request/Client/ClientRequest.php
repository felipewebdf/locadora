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
            'document.numeric' => 'Favor informar o documento válido',
            'phone.required' => 'Favor informar o telefone válido',
            'credcard.required' => 'Favor informar o cartão',
            'credcard.numeric' => 'Favor informar o cartão válido',
            'credcard_at.required' => 'Favor informar a validade do cartão',
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
            'document' => 'required|numeric',
            'phone' => 'required|numeric',
            'credcard' => 'required|numeric',
            'credcard_at' => 'required',
            'description' => 'required',
            'district' => 'required',
            'city' => 'required',
            'uf' => 'required',
            'cep' => 'required'

        ];

        return $validator;
    }


}
