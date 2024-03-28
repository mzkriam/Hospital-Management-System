<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDoctorsRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            "name" => 'required|max:25|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            "email" => 'required|email|unique:doctors,email,' . $this->id,
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
            "phone" => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10|unique:doctors,phone,' . $this->id,
            "section_id" => 'required|exists:sections,id',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'number_of_statements' => 'required|min:0|numeric',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.email'),
            'email.unique' => trans('validation.unique'),
            'password.required' => trans('validation.required'),
            'password.string' => trans('validation.string'),
            'password.min' => trans('validation.min'),
            'password.regex' => trans('validation.regex'),
            'phone.required' => trans('validation.required'),
            'phone.numeric' => trans('validation.numeric'),
            'phone.unique' => trans('validation.unique'),
            'phone.regex' => trans('validation.regex'),
            'name.required' => trans('validation.required'),
            'name.regex' => trans('validation.regex'),
            'name.max' => trans('validation.max'),
            'section_id.required' => trans('validation.required'),
            'appointments.required' => trans('validation.required'),
            'number_of_statements.required' => trans('validation.required'),
            'number_of_statements.min' => trans('validation.min'),
            'number_of_statements.numeric' => trans('validation.numeric'),
        ];
    }
}
