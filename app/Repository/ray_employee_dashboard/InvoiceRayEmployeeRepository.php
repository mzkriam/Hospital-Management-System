<?php

namespace App\Repository\ray_employee_dashboard;

use App\Events\CreateInvoice;
use App\Interfaces\ray_employee_dashboard\InvoiceRayEmployeeRepositoryInterface;
use App\Models\Notification;
use App\Models\PatientAccount;
use App\Models\RayService;
use App\Models\Patient;
use App\Traits\UploadTrait;
use Illuminate\Support\Facades\DB;

class InvoiceRayEmployeeRepository implements InvoiceRayEmployeeRepositoryInterface
{
    use UploadTrait;
    public function index()
    {
        $invoices = RayService::where('case', 0)->get();
        return view('Dashboard.dashboard_RayEmployee.invoices.index', compact('invoices'));
    }
    public function completedRay()
    {
        $invoices = RayService::where('case', 1)->where('ray_employ_id', auth()->user()->id)->get();
        return view('Dashboard.dashboard_RayEmployee.invoices.completed_invoices', compact('invoices'));
    }
    public function edit($id)
    {
        $invoice = RayService::findOrFail($id);
        return view('Dashboard.dashboard_RayEmployee.invoices.add_diagnosis', compact('invoice'));
    }

    public function update($request, $id)
    {
        DB::beginTransaction();
        try {
            $invoice = RayService::findOrFail($id);
            $invoice->update([
                'price' => $request->price,
                'ray_employ_id' => auth()->user()->id,
                'code' => $request->code,
                'name' => $request->name,
                'description_employee' => $request->description_employee,
                'case' => 1,
            ]);
            if ($request->hasFile('photos')) {
                foreach ($request->photos as $photo) {
                    $this->verifyAndStoreImageForeach($photo, 'Rays', 'upload_image', $invoice->id, 'App\Models\RayService');
                }
            }
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->ray_id = $invoice->id;
            $patient_accounts->patient_id = $invoice->patient_id;
            $patient_accounts->invoice_id = $invoice->invoice_id;
            $patient_accounts->Debit = $invoice->price;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            $patient = Patient::find($patient_accounts->patient_id);
            $notifications = new Notification();
            $notifications->patient_id = $invoice->patient_id;
            $notifications->user_id = $invoice->doctor_id;
            $notifications->invoice_id = $invoice->invoice_id;
            $notifications->message = "new examination : " . $patient->name;
            $notifications->save();

            // $data = [
            //     'patient' => $patient_accounts->patient_id,
            //     'invoice_id' => $invoice->invoice_id,
            //     'doctor_id' => $invoice->doctor_id,
            // ];
            // event(new CreateInvoice($data));

            DB::commit();
            session()->flash('add');
            return redirect()->route('invoice_ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function viewRay($id)
    {
        $rays = RayService::findOrFail($id);
        $patient = Patient::findOrFail($rays->patient_id);
        if (auth()->user()->id != $rays->ray_employ_id) {
            return redirect()->route('404');
        } else {
            return view('Dashboard.dashboard_RayEmployee.invoices.patient_details', compact('rays', 'patient'));
        }
    }
    public function viewRequired($id)
    {
        $rays = RayService::findOrFail($id);
        $notification = Notification::where('ray_service_id', $rays->id)->first();
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        $patient = Patient::findOrFail($rays->patient_id);
        return view('Dashboard.dashboard_RayEmployee.invoices.patient_details_before', compact('rays', 'patient'));
    }
    public function viewNotification($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        $rays = RayService::findOrFail($notification->ray_service_id);
        $patient = Patient::findOrFail($rays->patient_id);
        return view('Dashboard.dashboard_RayEmployee.invoices.patient_details_before', compact('rays', 'patient'));
    }
}
