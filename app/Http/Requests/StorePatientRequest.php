<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "name" => 'required|max:30',
            "Gender" => 'required|integer|in:1,2',
            'Date_Birth' => 'required|date|date_format:Y-m-d',
            "Blood_Group" => 'required',
            "insurance_id" => 'nullable|exists:insurances,id',
            "Address" => 'required|max:40',
            "email" => 'required|email|unique:patients,email,' . $this->id,
            "Phone" => 'required|numeric|unique:patients,Phone,' . $this->id,
            'password' => [
                'sometimes',
                'required',
                'string',
                'min:8',             // must be at least 8 characters in length
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.sometimes' => trans('validation.sometimes'),
            'Phone.required' => trans('validation.required'),
            'Phone.unique' => trans('validation.unique'),
            'Phone.numeric' => trans('validation.numeric'),
            'Date_Birth.required' => trans('validation.required'),
            'Date_Birth.date' => trans('validation.date'),
            'Gender.required' => trans('validation.required'),
            'Gender.integer' => trans('validation.integer'),
            'Blood_Group.required' => trans('validation.required'),
        ];
    }
}
