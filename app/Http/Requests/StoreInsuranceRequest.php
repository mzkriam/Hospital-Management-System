<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInsuranceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|unique:insurance_translations,name,' . $this->id,
            'insurance_code' => 'required|unique:insurances,insurance_code,' . $this->id,
            'contact_number' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:insurances,contact_number,' . $this->id,
            'notes' => 'nullable|max:255',
            'discount_percentage' => 'required|numeric',
            'company_rate' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'insurance_code.required' => trans('validation.required'),
            'insurance_code.unique' => trans('validation.unique'),

            'contact_number.required' => trans('validation.required'),
            'contact_number.unique' => trans('validation.unique'),
            'contact_number.numeric' => trans('validation.unique'),
            'contact_number.regex' => trans('validation.unique'),
            'contact_number.min' => trans('validation.unique'),

            'discount_percentage.required' => trans('validation.required'),
            'discount_percentage.numeric' => trans('validation.numeric'),

            'notes.max' => trans('validation.max'),

            'company_rate.required' => trans('validation.required'),
            'company_rate.numeric' => trans('validation.numeric'),

            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
        ];
    }
}
