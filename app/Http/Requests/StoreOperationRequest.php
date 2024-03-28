<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOperationRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required|max:25|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            'price' => 'required|regex:/^\d+(\.\d{2,3})?$/',
            "description" => 'required|max:255',
            "doctor_id" => 'nullable|exists:doctors,id',
            "medicine_id" => 'nullable|exists:medicines,id',
            "procedures" => 'nullable|max:255',
            "warnings" => 'nullable|max:255',
            "side_effects" => 'nullable|max:255',
            "results" => 'nullable|max:255',
        ];
    }
    public function messages()
    {
        return [
            'description.required' => trans('validation.required'),
            'doctor_id.exists' => trans('validation.exists'),
            'email.unique' => trans('validation.unique'),
            'price.required' => trans('validation.required'),
            'price.regex' => trans('validation.regex'),
            'medicine_id.exists' => trans('validation.exists'),
            'description.max' => trans('validation.max'),
            'procedures.max' => trans('validation.max'),
            'warnings.max' => trans('validation.max'),
            'side_effects.max' => trans('validation.max'),
            'results.max' => trans('validation.max'),
            'name.required' => trans('validation.required'),
            'name.regex' => trans('validation.regex'),
            'name.max' => trans('validation.max'),
        ];
    }
}
