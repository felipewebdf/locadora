<?php

namespace App\Http\Request\Cars;

use Illuminate\Foundation\Http\FormRequest;

class CarsRequest extends FormRequest
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
            'automaker.required' => 'Favor informar a montadora',
            'model.required' => 'Favor informar o modelo',
            'power.required' => 'Favor informar o potência',
            'year_factory.required' => 'Favor informar o ano de fabricação',
            'year.required' => 'Favor informar a o ano',
            'tag.required' => 'Favor informar a placa',
            'renavan.required' => 'Favor informar o renavan',
            'door.required' => 'Favor informar a quantidade de portas',
            'capacity.required' => 'Favor informar a capacidade',
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
            'automaker' => 'required',
            'model' => 'required',
            'power' => 'required',
            'year_factory' => 'required',
            'year' => 'required',
            'tag' => 'required',
            'renavan' => 'required',
            'door' => 'required',
            'capacity' => 'required',
        ];

        return $validator;
    }


}
