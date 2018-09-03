<?php

namespace App\Http\Request\Rent;

use Illuminate\Foundation\Http\FormRequest;

class InspectionRequest extends FormRequest
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
            'rent_id.required' => 'Favor informar o contrato',
            'init_km.required' => 'Favor informar a km inicial',
            'gasoline.required' => 'Favor informar a quantidade de combustível',
            'bodywork.required' => 'Favor informar as condições do veículo',
            'washed_out.required' => 'Favor informar a condição de lavagem'
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
            'rent_id' => 'required|integer',
            'init_km' => 'required',
            'gasoline' => 'required',
            'bodywork' => 'required',
            'washed_out' => 'required'
        ];

        return $validator;
    }


}
