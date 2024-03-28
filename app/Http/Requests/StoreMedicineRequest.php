<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMedicineRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|max:50|unique:medicine_translations,name,' . $this->id . ',medicine_id',
            'price' => 'required|regex:/^\d+(\.\d{2,3})?$/',
            'description' => 'nullable|max:255',
            'code' => 'nullable|max:10',
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
            'price.required' => trans('validation.required'),
            'price.regex' => trans('validation.regex'),
            'code.max' => trans('validation.max'),
            'pha_employee_id.max' => trans('validation.exists'),
        ];
    }
}
