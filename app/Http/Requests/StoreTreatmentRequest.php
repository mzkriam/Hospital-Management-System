<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTreatmentRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => 'required|max:25|regex:/^[A-Za-z0-9-أ-ي-pL\s\-]+$/u',
            "description" => 'required|max:255',
            "doctor_id" => 'required|exists:doctors,id',
            "patient_id" => 'required|exists:patients,id',
            "invoice_id" => 'required|exists:invoices,id',
            "medicine_id" => 'nullable|exists:medicines,id',
            "procedures" => 'nullable|max:255',
            "warnings" => 'nullable|max:255',
            "side_effects" => 'nullable|max:255',
            "results" => 'nullable|max:255',
            "review_date" => 'nullable|date_format:Y-m-d\TH:i',
        ];
    }
    public function messages()
    {
        return [
            'description.required' => trans('validation.required'),
            'description.max' => trans('validation.max'),
            'doctor_id.exists' => trans('validation.exists'),
            'doctor_id.required' => trans('validation.required'),
            'invoice_id.exists' => trans('validation.exists'),
            'invoice_id.required' => trans('validation.required'),
            'patient_id.exists' => trans('validation.exists'),
            'patient_id.required' => trans('validation.required'),
            'medicine_id.exists' => trans('validation.exists'),
            'procedures.max' => trans('validation.max'),
            'warnings.max' => trans('validation.max'),
            'side_effects.max' => trans('validation.max'),
            'results.max' => trans('validation.max'),
            'name.required' => trans('validation.required'),
            'name.regex' => trans('validation.regex'),
            'name.max' => trans('validation.max'),
            'review_date.max' => trans('validation.date_format'),
        ];
    }
}
