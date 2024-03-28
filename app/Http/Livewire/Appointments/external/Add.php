<?php

namespace App\Http\Livewire\Appointments\External;

use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Section;
use Livewire\Component;

class Add extends Component
{
    public function render()
    {
        return view(
            'livewire.appointments.external.add',
            [
                'sections' => Section::get(),
                'insurances' => Insurance::get(),
            ]
        );
    }

    public  $catchError, $AppointmentSaved;
    public  $Address, $notes, $name, $Blood_Group = "", $birth_patient,
        $gender = "", $phone, $email, $insurance_id = '', $method, $type, $appointment,
        $section_id = '', $patient_id = '';
    public $section_doctors = [];
    public $selected_doctor_id = "";
    public $message = false;
    public $message2 = false;
    public function get_doctors()
    {
        $section = Section::where('id', $this->section_id)->first();
        $this->section_doctors = $section->doctors ?? [];
    }
    public function store()
    {
        $validatedData = $this->validate([
            'gender' => 'required|in:male,female',
            'birth_patient' => 'required|date_format:Y-m-d',
            'Blood_Group' => 'required',
            'phone' => 'required|numeric|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'email' => 'required',
            'section_id' => 'required|exists:sections,id',
            'selected_doctor_id' => 'required|exists:doctors,id',
            'name' => 'required|max:20',
            'Address' => 'required|max:30',
            'notes' => 'required|max:255',
        ]);
        $appointment = new  Appointment();
        $appointment->method = 1;
        $appointment->type = 'uncertain';
        $appointment->gender = $this->gender;
        $appointment->birth_patient = $this->birth_patient;
        $appointment->Blood_Group = $this->Blood_Group;
        $appointment->insurance_id = $this->insurance_id;
        $appointment->phone = $this->phone;
        $appointment->email = $this->email;
        $appointment->section_id = $this->section_id;
        $appointment->doctor_id = $this->selected_doctor_id;
        $appointment->save();

        $appointment->name = $this->name;
        $appointment->Address = $this->Address;
        $appointment->notes = $this->notes;
        $appointment->save();

        $this->name = "";
        $this->Address = "";
        $this->notes = "";
        $this->gender = "";
        $this->birth_patient = "";
        $this->Blood_Group = "";
        $this->insurance_id = "";
        $this->phone = "";
        $this->email = "";
        $this->section_id = "";
        $this->selected_doctor_id = [];
        $this->message = true;
    }
}
