<?php

namespace App\Http\Livewire;

use App\Models\Section;
use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    protected $rules = [
        'section_doctors.*' => 'exists:doctors,id',
    ];

    public  $catchError, $ServiceSaved, $ServiceUpdated;
    public  $show_table = true;

    public $name, $price, $section_id = "", $doctor_id = "", $description;
    public $section_doctors = [];
    public $section_treatments = [];
    public $section_operations = [];
    public $medicines = [];

    public $selected_doctor_id = [], $selected_treatment_id, $selected_operation_id, $selected_medicine_id;


    public function render()
    {
        return view('livewire.Services.services', [
            'services' => Service::get(),
            'sections' => Section::get(),
        ]);
    }
    public function show_form_add()
    {
        $this->show_table = false;
    }
    public function show_table()
    {
        $this->show_table = true;
        $this->update_mode = false;
    }
    public $update_mode = false;
    public $service_id;
    public $service_selected;
    public function edit($id)
    {
        $this->service_selected = Service::findOrFail($id);
        $this->service_id = $this->service_selected->id;
        $this->update_mode = true;

        $this->name = $this->service_selected->name;
        $this->price = $this->service_selected->price;
        $this->section_id = $this->service_selected->section_id;
        $this->get_doctors();
        $this->doctor_id = $this->service_selected->doctor_id;
        $this->description = $this->service_selected->description;


        $this->show_table = false;
    }
    public function store_single()
    {
        $validatedData = $this->validate([
            'name' => 'required|max:50',
            'price' => 'required|regex:/^\d+(\.\d{2,3})?$/',
            'section_id' => 'required|exists:sections,id',
            'doctor_id' => 'required|exists:doctors,id',
            'description' => 'required|max:255',
        ]);
        try {
            if ($this->update_mode) {
                $single_service = Service::findOrFail($this->service_id);
                $this->ServiceUpdated = true;
                $this->ServiceSaved = false;
            } else {
                $single_service = new Service();
                $this->ServiceSaved = true;
                $this->ServiceUpdated = false;
            }
            $single_service->price = $this->price;
            $single_service->section_id = $this->section_id;
            if (auth('admin')->check()) {
                $single_service->accountings_id = NULL;
                $single_service->admin_id = auth()->user()->id;
            } else {
                $single_service->admin_id = NULL;
                $single_service->accountings_id = auth()->user()->id;
            }
            $single_service->doctor_id = $this->doctor_id;
            $single_service->save();
            $single_service->name = $this->name;
            $single_service->description = $this->description;
            $single_service->save();

            $this->name = "";
            $this->price = "";
            $this->section_id = "";
            $this->doctor_id = "";
            $this->description = "";
            $this->update_mode = false;
            $this->show_table = true;
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function get_doctors()
    {
        $section = section::where('id', $this->section_id)->first();
        $this->section_doctors = $section->doctors ?? [];
    }
    public $status = "";
    public function edit_status($id)
    {
        try {
            $this->service_id = $id;
            $this->service_selected = Service::FindOrFail($id);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status()
    {
        $validatedData = $this->validate([
            'status' => 'required|in:0,1',
        ]);
        try {
            $service = Service::findOrFail($this->service_id);
            if (auth('admin')->check()) {
                $service->update([
                    'accountings_id' => NULL,
                    'admin_id' => auth()->user()->id,
                    'status' => $this->status,
                ]);
            } else {
                $service->update([
                    'admin_id' => NULL,
                    'accountings_id' => auth()->user()->id,
                    'status' => $this->status,
                ]);
            }
            $this->ServiceSaved = false;
            $this->ServiceUpdated = true;
            if (auth('admin')->check()) {
                return redirect()->route('admin.service');
            } else {
                return redirect()->route('service');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function delete($id)
    {
        $this->service_id = $id;
        $this->service_selected = Service::FindOrFail($this->service_id);
    }
    public function destroy()
    {
        try {
            Service::destroy($this->service_id);
            if (auth('admin')->check()) {
                return redirect()->route('admin.service');
            } else {
                return redirect()->route('service');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
