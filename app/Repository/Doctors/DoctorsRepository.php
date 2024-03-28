<?php

namespace App\Repository\Doctors;

use App\Interfaces\Doctors\DoctorRepositoryInterface;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\LabService;
use App\Models\RayService;
use App\Models\Schedule;
use App\Models\Section;
use App\Models\Operation;
use App\Models\Patient;
use App\Models\Treatment;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorsRepository implements DoctorRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $doctors = Doctor::get();
        return view('Dashboard.Doctors.index', compact('doctors'));
    }

    public function create()
    {
        $sections = Section::all();
        return view('Dashboard.Doctors.add', compact('sections'));
    }


    public function store($request)
    {
        DB::beginTransaction();
        try {
            $doctors = new Doctor();
            $doctors->email = $request->email;
            $doctors->password = Hash::make($request->password);
            $doctors->section_id = $request->section_id;
            $doctors->phone = $request->phone;
            $doctors->status = 1;
            $doctors->number_of_statements =  $request->number_of_statements;
            $doctors->save();

            $doctors->name = $request->name;
            $doctors->save();

            foreach ($request->schedules as $day => $times) {
                if ($times['start'] && $times['end']) {
                    $doctors->schedules()->create([
                        'day' => $day,
                        'start_time' => $times['start'],
                        'end_time' => $times['end'],
                    ]);
                }
            }

            $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $doctors->id, 'App\Models\Doctor');

            DB::commit();
            session()->flash('add');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $doctor = Doctor::findOrFail($id);
        $sections = Section::get();
        return view('Dashboard.Doctors.edit', compact('sections', 'doctor'));
    }


    public function update($request)
    {
        DB::beginTransaction();
        try {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->email = $request->email;
            $doctor->section_id = $request->section_id;
            $doctor->phone = $request->phone;
            $doctor->save();

            $doctor->name = $request->name;
            $doctor->save();

            foreach ($request->schedules as $day => $times) {
                if (isset($times['cancel'])) {
                    $schedule = $doctor->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        Schedule::destroy($schedule->id);
                    }
                } elseif ($times['start'] && $times['end']) {
                    $schedule = $doctor->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        $schedule->update([
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    } else {
                        $doctor->schedules()->create([
                            'day' => $day,
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    }
                }
            }


            if ($request->has('photo')) {
                // Delete old photo
                if ($doctor->image) {
                    $old_img = $doctor->image->filename;
                    $this->Delete_attachment('upload_image', 'doctors/' . $old_img, $request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request, 'photo', 'doctors', 'upload_image', $request->id, 'App\Models\Doctor');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if ($request->page_id == 1) {
            if ($request->filename) {
                $this->Delete_attachment('upload_image', 'doctors/' . $request->filename, $request->id);
            }
            Doctor::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Doctors.index');
        }
    }
    public function update_password($request)
    {
        try {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash("edit");
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            $doctor = Doctor::findOrFail($request->id);
            $doctor->update([
                'status' => $request->status
            ]);
            session()->flash("edit");
            return redirect()->route('Doctors.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function showInvoices($id)
    {
        $invoices = Invoice::where('doctor_id', $id)->where('invoice_status', 1)->get();
        return view('Dashboard\doctor\invoices\index', compact('invoices'));
    }
    public function reviewInvoices($id)
    {
        $invoices = Invoice::where('doctor_id', $id)->where('invoice_status', 2)->get();
        return view('Dashboard.Doctor.invoices.review_invoices', compact('invoices'));
    }
    public function completedInvoices($id)
    {
        $invoices = Invoice::where('doctor_id', $id)->where('invoice_status', 3)->get();
        return view('Dashboard.Doctor.invoices.completed_invoices', compact('invoices'));
    }
    public function showRay($id)
    {
        $rays = RayService::findOrFail($id);
        return view('Dashboard.Doctor.invoices.view_rays', compact('rays'));
    }
    public function showLaboratory($id)
    {
        $laboratories  = LabService::findOrFail($id);
        return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratories'));
    }
    public function showPatientDoctor($id)
    {
        $patient = Patient::FindOrFail($id);
        $patient_rays = RayService::where('patient_id', $id)->get();
        $patient_Laboratories = LabService::where('patient_id', $id)->get();
        $invoices = Invoice::where('patient_id', $id)->get();
        $patient_records = Treatment::where('patient_id', $id)->orderBy('date', 'asc')->get();
        $patient_operations = Operation::where('patient_id', $id)->orderBy('created_at', 'asc')->get();
        return view('Dashboard.Doctors.patient_record', compact('patient', 'patient_rays', 'patient_Laboratories', 'patient_records', 'patient_operations'));
    }
    public function showTreatment($id)
    {
        $treatments = Treatment::where('doctor_id', $id)->get();
        return view('Dashboard.Treatments.index', compact('treatments'));
    }
    public function showOperation($id)
    {
        $operations = Operation::where('doctor_id', $id)->get();
        return view('Dashboard.Operations.index', compact('operations'));
    }
    public function showAppointments($id)
    {
        $doctor = Doctor::findOrFail($id);
        return view('Dashboard.Doctors.appointments', compact('doctor'));
    }
}
