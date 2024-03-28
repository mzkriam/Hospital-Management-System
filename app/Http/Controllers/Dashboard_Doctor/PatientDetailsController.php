<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;

use App\Models\LabService;
use App\Models\RayService;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Operation;
use App\Models\Treatment;

class PatientDetailsController extends Controller
{
    public function index($id)
    {
        $invoice = Invoice::FindOrFail($id);
        $notification = Notification::where('invoice_id', $invoice->id)->first();
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        $patient = $invoice->Patient;
        $patient_records = Treatment::where('patient_id', $patient->id)->orderBy('date', 'asc')->get();
        $patient_operations = Operation::where('patient_id', $patient->id)->orderBy('created_at', 'asc')->get();
        $patient_rays = RayService::where('patient_id', $patient->id)->get();
        $patient_Laboratories = LabService::where('patient_id', $patient->id)->get();
        return view(
            'Dashboard.Doctor.invoices.patient_record',
            compact('patient', 'patient_rays', 'patient_Laboratories', 'patient_records', 'patient_operations')
        );
    }
    public function invoice_details($id)
    {
        $notification = Notification::FindOrFail($id);
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        $patient = $notification->Patient;
        $patient_records = Treatment::where('patient_id', $patient->id)->orderBy('date', 'asc')->get();
        $patient_operations = Operation::where('patient_id', $patient->id)->orderBy('created_at', 'asc')->get();
        $patient_rays = RayService::where('patient_id', $patient->id)->get();
        $patient_Laboratories = LabService::where('patient_id', $patient->id)->get();
        return view(
            'Dashboard.Doctor.invoices.patient_record',
            compact('patient', 'patient_rays', 'patient_Laboratories', 'patient_records', 'patient_operations')
        );
    }
}
