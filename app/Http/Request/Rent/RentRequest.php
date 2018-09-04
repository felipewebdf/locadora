<?php

namespace App\Http\Request\Rent;

use Illuminate\Foundation\Http\FormRequest;

class RentRequest extends FormRequest
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
            'client_id.required' => 'Favor informar o cliente',
            'car_id.required' => 'Favor informar o veículo',
            'type_rent_id.required' => 'Favor informar o tipo de locação',
//            'type_rent_id.numeric' => 'Favor informar o tipo de locação válido',
            'daily.required' => 'Favor informar o valor da diária',
            'total_km.required' => 'Favor informar a km por dia',
            'value_km_extra.required' => 'Favor informar o valor da km extra',
            'init.required' => 'Favor informar a data de início da locação',
            'end.required' => 'Favor informar a data de término da locação'
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
            'client_id' => 'required|integer',
            'car_id' => 'required|integer',
            'type_rent_id' => 'required',
            'daily' => 'required',
            'total_km' => 'required|integer',
            'value_km_extra' => 'required',
            'init' => 'required|date',
            'end' => 'required|date'
        ];

        return $validator;
    }


}
