<?php

namespace App\Repository\laboratory_employee_dashboard;

use App\Events\CreateInvoice;
use App\Interfaces\laboratory_employee_dashboard\InvoiceLaboratoryEmployeeRepositoryInterface;
use App\Models\LabService;
use App\Models\Notification;
use App\Models\PatientAccount;
use App\Models\Patient;
use App\Traits\uploadTrait;
use Illuminate\Support\Facades\DB;


class InvoiceLaboratoryEmployeeRepository implements InvoiceLaboratoryEmployeeRepositoryInterface
{
    use uploadTrait;
    public function index()
    {
        $invoices = LabService::where('case', 0)->get();
        return view('Dashboard.dashboard_LaboratoryEmployee.invoices.index', compact('invoices'));
    }
    public function completedInvoicesLaboratoryEmployee()
    {
        $invoices = LabService::where('case', 1)->where('lab_employ_id', auth()->user()->id)->get();
        return view('Dashboard.dashboard_LaboratoryEmployee.invoices.completed_invoices', compact('invoices'));
    }
    public function edit($id)
    {
        $invoice = LabService::findOrFail($id);
        return view('Dashboard.dashboard_LaboratoryEmployee.invoices.add_diagnosis', compact('invoice'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $invoice_patient = LabService::findOrFail($id);
            $invoice_patient->update([
                'price' => $request->price,
                'lab_employ_id' => auth()->user()->id,
                'code' => $request->code,
                'name' => $request->name,
                'description_employee' => $request->description_employee,
                'case' => 1,
            ]);
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $this->verifyAndStoreImageForeach($photo, 'laboratories', 'upload_image', $invoice_patient->id, 'App\Models\LabService');
                }
            }
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->lab_id = $invoice_patient->id;
            $patient_accounts->invoice_id = $invoice_patient->invoice_id;
            $patient_accounts->patient_id = $invoice_patient->patient_id;
            $patient_accounts->Debit = $invoice_patient->price;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            $patient = Patient::find($patient_accounts->patient_id);
            $notifications = new Notification();
            $notifications->patient_id = $invoice_patient->patient_id;
            $notifications->user_id = $invoice_patient->doctor_id;
            $notifications->invoice_id = $invoice_patient->invoice_id;
            $notifications->message = "new examination : " . $patient->name;
            $notifications->save();

            // $data = [
            //     'patient' => $patient_accounts->patient_id,
            //     'invoice_id' => $invoice_patient->invoice_id,
            //     'doctor_id' => $invoice_patient->doctor_id,
            // ];
            // event(new CreateInvoice($data));

            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices_laboratory_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function viewLaboratory($id)
    {
        $laboratory = LabService::findOrFail($id);
        $patient = Patient::findOrFail($laboratory->patient_id);
        if (auth()->user()->id != $laboratory->lab_employ_id) {
            return redirect()->route('404');
        } else {
            return view('Dashboard.dashboard_LaboratoryEmployee.invoices.patient_details', compact('laboratory', 'patient'));
        }
    }
    public function viewRequired($id)
    {
        $laboratory = LabService::findOrFail($id);
        $notification = Notification::where('lab_service_id', $laboratory->id)->first();
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        $patient = Patient::findOrFail($laboratory->patient_id);
        return view('Dashboard.dashboard_LaboratoryEmployee.invoices.patient_details_before', compact('laboratory', 'patient'));
    }
    public function viewNotification($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        $laboratory = LabService::findOrFail($notification->lab_service_id);
        $patient = Patient::findOrFail($laboratory->patient_id);
        return view('Dashboard.dashboard_LaboratoryEmployee.invoices.patient_details_before', compact('laboratory', 'patient'));
    }
}
