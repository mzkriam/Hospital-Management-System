<?php

namespace App\Repository\AccountingEmployee;

use App\Interfaces\AccountingEmployee\AccountingEmployeeRepositoryInterface;
use App\Models\Accounting;
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

class AccountingEmployeeRepository implements AccountingEmployeeRepositoryInterface
{
    use UploadTrait;

    public function index()
    {
        $accounting_employees = Accounting::get();
        return view('Dashboard.accounting_employee.index', compact('accounting_employees'));
    }

    public function create()
    {
        return view('Dashboard.accounting_employee.add');
    }


    public function store($request)
    {

        DB::beginTransaction();
        try {
            $accounting_employee = new Accounting();
            $accounting_employee->email = $request->email;
            $accounting_employee->phone = $request->phone;
            $accounting_employee->status = 1;
            $accounting_employee->password = Hash::make($request->password);
            $accounting_employee->save();

            $accounting_employee->name = $request->name;
            $accounting_employee->description = $request->description;
            $accounting_employee->job_title = $request->job_title;
            $accounting_employee->save();

            foreach ($request->schedules as $day => $times) {
                if ($times['start'] && $times['end']) {
                    $accounting_employee->schedules()->create([
                        'day' => $day,
                        'start_time' => $times['start'],
                        'end_time' => $times['end'],
                    ]);
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('accounting_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $accounting_employee = Accounting::findOrFail($id);
        return view('Dashboard.accounting_employee.edit', compact('accounting_employee'));
    }

    public function update($request)
    {
        DB::beginTransaction();
        try {
            $accounting_employee = Accounting::findOrFail($request->id);
            $accounting_employee->email = $request->email;
            $accounting_employee->phone = $request->phone;
            $accounting_employee->save();

            $accounting_employee->name = $request->name;
            $accounting_employee->save();

            foreach ($request->schedules as $day => $times) {
                if (isset($times['cancel'])) {
                    $schedule = $accounting_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        Schedule::destroy($schedule->id);
                    }
                } elseif ($times['start'] && $times['end']) {
                    $schedule = $accounting_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        $schedule->update([
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    } else {
                        $accounting_employee->schedules()->create([
                            'day' => $day,
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    }
                }
            }


            if ($request->has('photo')) {
                // Delete old photo
                if ($accounting_employee->image) {
                    $old_img = $accounting_employee->image->filename;
                    $this->Delete_attachment('upload_image', 'accounting_employee/' . $old_img, $request->id);
                }
                //Upload img
                $this->verifyAndStoreImage($request, 'photo', 'accounting_employee', 'upload_image', $request->id, 'App\Models\Accounting');
            }

            DB::commit();
            session()->flash('edit');
            return redirect()->route('accounting_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function destroy($request)
    {
        if ($request->page_id == 1) {
            if ($request->filename) {
                $this->Delete_attachment('upload_image', 'accounting_employee/' . $request->filename, $request->id);
            }
            Accounting::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('accounting_employee.index');
        }
    }
    public function update_password($request)
    {
        try {
            $doctor = Accounting::findOrFail($request->id);
            $doctor->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash("edit");
            return redirect()->route('accounting_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            $doctor = Accounting::findOrFail($request->id);
            $doctor->update([
                'status' => $request->status
            ]);
            session()->flash("edit");
            return redirect()->route('accounting_employee.index');
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
        $invoices = Invoice::where('patient_id', $id)->get();
        foreach ($invoices as $invoice) {
            $patient_records = Treatment::where('patient_id', $id)->orderBy('date', 'asc')->get();
            $patient_operations = Operation::where('patient_id', $id)->orderBy('created_at', 'asc')->get();
            $patient = Patient::FindOrFail($id);
            $patient_rays = RayService::where('patient_id', $id)->get();
            $patient_Laboratories = LabService::where('patient_id', $id)->get();
            // return view('Dashboard.doctor.invoices.patient_details', compact('patient_records', 'patient_rays', 'patient_Laboratories'));
            return view('Dashboard.Doctors.patient_record', compact('patient', 'patient_rays', 'patient_Laboratories', 'patient_records', 'patient_operations'));
        }
    }
    public function showTreatment($id)
    {
        $treatments = Treatment::where('doctor_id', $id)->get();
        return view('Dashboard.Treatments.index', compact('treatments'));
    }
    public function showAppointments($id)
    {
        $doctor = Accounting::findOrFail($id);
        return view('Dashboard.Doctors.appointments', compact('doctor'));
    }
}
