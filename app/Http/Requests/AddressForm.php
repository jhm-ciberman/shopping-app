<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressForm extends FormRequest
{
    private $defaults = [
        'street_number' => null,
        'references'    => null,
        'country_code'  => 'ar',
        'zip_code'      => '7600',
        'state'         => 'Buenos Aires',
        'city'          => 'Mar del Plata',
    ];

    /**
     * Get data to be validated from the request.
     *
     * @return array
     */
    protected function validationData()
    {
        return array_merge($this->defaults, $this->all());
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact'         => 'required|min:3',
            'phone'           => 'required|min:7',
            'country_code'    => 'required|country',
            'street_name'     => 'required|min:3',
            'street_number'   => 'nullable|required_without:references',
            'zip_code'        => 'required',
            'state'           => 'required|min:2',
            'city'            => 'required|min:3',
            'additional_info' => 'nullable',
            'between'         => 'nullable',
            'references'      => 'nullable|required_without:street_number',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [];
    }
}
