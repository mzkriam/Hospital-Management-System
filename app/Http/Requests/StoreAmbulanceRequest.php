<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAmbulanceRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'driver_name' => 'required|max:25',
            'car_number' => 'required|unique:ambulances,car_number,' . $this->id,
            'car_model' => 'required',
            'car_year_made' => 'required|date',
            'car_type' => "required|in:1,2",
            'driver_license_number' => 'required|numeric|unique:ambulances,driver_license_number,' . $this->id,
            'driver_phone' => 'required|numeric|unique:ambulances,driver_phone,' . $this->id,
            'notes' => 'required|max:255',
        ];
    }

    public function messages()
    {
        return [
            'car_number.required' => trans('validation.required'),
            'car_model.required' => trans('validation.required'),
            'car_year_made.required' => trans('validation.required'),
            'car_year_made.numeric' => trans('validation.numeric'),
            'car_type.required' => trans('validation.required'),
            'driver_name.required' => trans('validation.required'),
            'driver_name.unique' => trans('validation.unique'),
            'driver_license_number.required' => trans('validation.required'),
            'driver_license_number.numeric' => trans('validation.numeric'),
            'driver_phone.required' => trans('validation.required'),
            'driver_phone.numeric' => trans('validation.numeric'),
        ];
    }
}
