<?php

namespace App\Http\Livewire\Appointments\Internal;

use App\Models\Appointment;
use App\Models\Insurance;
use App\Models\Patient;
use App\Models\Section;
use Livewire\Component;


class AppointmentInternal extends Component
{
    public  $show_table = true;
    public  $show_edit = false;
    public  $show_add = false;

    public  $catchError, $AppointmentSaved, $AppointmentUpdated;


    public  $Address, $notes, $name, $Blood_Group, $birth_patient,
        $gender, $phone, $email, $insurance_id = '', $method, $type, $appointment,
        $section_id = '', $patient_id = '', $patient;


    public $section_doctors = [];
    public $selected_doctor_id = '';
    public function render()
    {
        return view('livewire.appointments.internal.appointment-internal', [
            'appointments' => Appointment::where('method', 0)->get(),
            'sections' => Section::get(),
            'patients' => Patient::get(),
            'insurances' => Insurance::get(),
        ]);
    }
    public function show_form_add()
    {
        $this->show_table = false;
        $this->show_edit = false;
        $this->show_add = true;
    }
    public function show_table()
    {
        $this->show_table = true;
        $this->show_edit = false;
        $this->show_add = false;
    }
    public function get_doctors()
    {
        $section = section::where('id', $this->section_id)->first();
        $this->section_doctors = $section->doctors ?? [];
    }
    public function get_patients()
    {
        $this->patient = Patient::findOrFail($this->patient_id);
        $this->email = $this->patient->email;
        $this->insurance_id = $this->patient->insurance_id;
        $this->phone = $this->patient->Phone;
        $this->gender = $this->patient->Gender;
        $this->Blood_Group = $this->patient->Blood_Group;
        $this->birth_patient = $this->patient->Date_Birth;
        $this->name = $this->patient->name;
        $this->Address = $this->patient->Address;
    }
    public function store()
    {
        $validatedData = $this->validate([
            'patient_id' => 'required|exists:patients,id',
            'section_id' => 'required|exists:sections,id',
            'selected_doctor_id' => 'required|exists:doctors,id',
            'appointment' => 'required|date_format:Y-m-d\TH:i',
            'notes' => 'required|max:255',
        ]);
        try {
            $appointment = new  Appointment();
            $appointment->method = 0;
            $appointment->type = 'certain';
            $appointment->patient_id = $this->patient_id;
            if (auth('admin')->check()) {
                $appointment->admin_id = auth()->user()->id;
            } else {
                $appointment->reception_id = auth()->user()->id;
            }
            $appointment->section_id = $this->section_id;
            $appointment->doctor_id = $this->selected_doctor_id;
            $appointment->appointment = $this->appointment;
            $appointment->email = $this->email;
            $appointment->insurance_id = $this->insurance_id;
            $appointment->phone = $this->phone;
            $appointment->gender = $this->gender;
            $appointment->birth_patient = $this->birth_patient;
            $appointment->Blood_Group = $this->Blood_Group;
            $appointment->save();
            $appointment->notes = $this->notes;
            $appointment->name = $this->name;
            $appointment->Address = $this->Address;
            $appointment->save();
            $this->patient_id = "";
            $this->section_id = "";
            $this->selected_doctor_id = "";
            $this->appointment = "";
            $this->notes = "";
            $this->email = "";
            $this->insurance_id = "";
            $this->phone = "";
            $this->gender = "";
            $this->Blood_Group = "";
            $this->birth_patient = "";
            $this->name = "";
            $this->Address = "";
            $this->AppointmentSaved = true;
            $this->show_table = true;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public $appointment_id;
    public $appointment_selected;
    public function delete($id)
    {
        $this->appointment_id = $id;
        $this->appointment_selected = Appointment::FindOrFail($this->appointment_id);
    }
    public function destroy()
    {
        try {
            Appointment::destroy($this->appointment_id);
            if (auth('admin')->check()) {
                return redirect()->route('admin_appointments.internal');
            } else {
                return redirect()->route('appointments.internal');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        try {
            $this->AppointmentSaved = false;
            $this->show_table = false;
            $this->show_add = false;
            $this->show_edit = true;
            $this->appointment_id = $id;
            $this->appointment_selected = Appointment::FindOrFail($this->appointment_id);
            $this->patient_id = $this->appointment_selected->patient_id;
            $this->section_id = $this->appointment_selected->section_id;
            $this->get_doctors();
            // $this->selected_doctor_id = $this->appointment_selected->selected_doctor_id;
            $this->appointment = $this->appointment_selected->appointment;
            $this->notes = $this->appointment_selected->notes;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update()
    {
        try {
            // $validatedData = $this->validate([
            //     'patient_id' => 'required|exists:patients,id',
            //     'section_id' => 'required|exists:sections,id',
            //     'selected_doctor_id' => 'required|exists:doctors,id',
            //     'appointment' => 'required|date_format:Y-m-d\TH:i',
            //     'notes' => 'required|max:255',
            // ]);
            $appointment = Appointment::findOrFail($this->appointment_id);

            $appointment->method = 0;
            $appointment->type = 'certain';
            $appointment->patient_id = $this->patient_id;
            if (auth('admin')->check()) {
                $appointment->reception_id = NULL;
                $appointment->admin_id = auth()->user()->id;
            } else {
                $appointment->admin_id = NULL;
                $appointment->reception_id = auth()->user()->id;
            }
            $appointment->section_id = $this->section_id;
            $this->get_doctors();
            $appointment->doctor_id = $this->selected_doctor_id;
            $appointment->appointment = $this->appointment;
            $appointment->birth_patient = $this->birth_patient;
            $appointment->save();
            $appointment->notes = $this->notes;
            $appointment->name = $this->name;
            $appointment->Address = $this->Address;
            $appointment->save();
            $this->patient_id = "";
            $this->section_id = "";
            $this->selected_doctor_id = "";
            $this->appointment = "";
            $this->notes = "";
            $this->email = "";
            $this->insurance_id = "";
            $this->phone = "";
            $this->gender = "";
            $this->Blood_Group = "";
            $this->birth_patient = "";
            $this->name = "";
            $this->Address = "";
            $this->AppointmentUpdated = true;
            $this->show_table = true;
            if (auth('admin')->check()) {
                return redirect()->route('admin_appointments.internal');
            } else {
                return redirect()->route('appointments.internal');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit_status($id)
    {
        try {
            $this->appointment_id = $id;
            $this->appointment_selected = Appointment::FindOrFail($this->appointment_id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public $new_status = "";
    public function update_status()
    {
        $validatedData = $this->validate([
            'new_status' => 'required|in:uncertain,certain,expired,canceled',
        ]);
        try {
            $appointment = Appointment::findOrFail($this->appointment_id);
            if (auth('admin')->check()) {
                $appointment->reception_id = NULL;
                $appointment->admin_id = auth()->user()->id;
                $appointment->type = $this->new_status;
                $appointment->save();
                $this->AppointmentUpdated = true;
                return redirect()->route('admin_appointments.internal');
            } else {
                $appointment->admin_id = NULL;
                $appointment->reception_id = auth()->user()->id;
                $appointment->type = $this->new_status;
                $appointment->save();
                $this->AppointmentUpdated = true;
                return redirect()->route('appointments.internal');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
