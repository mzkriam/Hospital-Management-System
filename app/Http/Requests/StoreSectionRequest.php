<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name' => 'required|max:25|unique:section_translations,name,' . $this->id . ',section_id',
            'description' => 'required|max:255',
            'location' => 'nullable|string|max:255',
            'contact_number' => 'nullable|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:sections,contact_number,' . $this->id,
            'head_of_department' => 'nullable|unique:section_translations,head_of_department,' . $this->id . ',section_id',
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
            'location.string' => trans('validation.string'),
            'location.max' => trans('validation.max'),
            'contact_number.regex' => trans('validation.regex'),
            'contact_number.min' => trans('validation.min'),
            'contact_number.unique' => trans('validation.unique'),
            'head_of_department.unique' => trans('validation.unique'),
        ];
    }
}
