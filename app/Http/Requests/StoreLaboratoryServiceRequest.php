<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLaboratoryServiceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|max:25|unique:lab_service_translations,name,' . $this->id . ',lab_service_id',
            'description' => 'required|max:255',
            'price' => 'nullable|regex:/^\d+(\.\d{2,3})?$/',
            'code' => 'nullable|max:10',
            'lab_employ_id' => 'nullable|exists:lab_employees,id',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => trans('validation.required'),
            'name.unique' => trans('validation.unique'),
            'name.max' => trans('validation.max'),
            'description.required' => trans('validation.required'),
            'description.max' => trans('validation.max'),
            'price.nullable' => trans('validation.nullable'),
            'price.regex' => trans('validation.regex'),
            'code.max' => trans('validation.max'),
            'lab_employ_id.exists' => trans('validation.exists'),
        ];
    }
}
