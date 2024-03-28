<?php

namespace App\Repository\patient_dashboard;

use App\Interfaces\patient_dashboard\InvoicePatientRepositoryInterface;
use App\Models\Invoice;
use App\Models\LabService;
use App\Models\RayService;
use App\Models\ReceiptAccount;
use App\Models\Patient;
use App\Models\Operation;
use App\Models\Treatment;
use App\Models\PatientAccount;
use Illuminate\Support\Facades\DB;

class  InvoicePatientRepository  implements InvoicePatientRepositoryInterface
{
    public function invoices()
    {
        $id = auth()->user()->id;
        $patient = Patient::FindOrFail($id);
        $patient_medicines = $patient->Medicines()->get();
        $Invoices = Invoice::where('patient_id', $id)->get();
        $receipts = ReceiptAccount::where('patient_id', $id)->get();
        $patient_operations = Operation::where('patient_id', $id)->orderBy('created_at', 'asc')->get();
        $patient_rays = RayService::where('patient_id', $id)->get();
        $patient_Laboratories = LabService::where('patient_id', $id)->get();
        $patient_records = Treatment::where('patient_id', $id)->orderBy('date', 'asc')->get();
        return view('Dashboard.dashboard_patient.invoicesPatient', compact(
            'patient',
            'Invoices',
            'receipts',
            'patient_operations',
            'patient_rays',
            'patient_Laboratories',
            'patient_medicines',
            'patient_records',
        ));
    }
    public function showInvoice()
    {
        $id = auth()->user()->id;
        $Invoice = Invoice::findOrFail($id);
        $patient = Patient::FindOrFail($Invoice->patient_id);
        $receipts = ReceiptAccount::where('invoice_id', $Invoice->id)->get();
        if ($Invoice->type == 1) {
            $account_patients = PatientAccount::select(
                DB::raw('sum(Debit) as total_debit'),
                DB::raw('sum(credit) as total_credit')
            )
                ->where('patient_id', $patient->id)
                ->where('invoice_id', $Invoice->id)
                ->groupBy('patient_id', 'invoice_id')
                ->FIRST();
            if ($account_patients) {
                $total_invoice = $Invoice->total_with_tax + $account_patients->total_debit;
            } else {
                $total_invoice = $Invoice->total_with_tax;
            }
        } elseif ($Invoice->type == 2) {
            $account_patients = PatientAccount::select(
                DB::raw('sum(Debit) as total_debit'),
                DB::raw('sum(credit) as total_credit')
            )
                ->where('patient_id', $patient->id)
                ->where('invoice_id', $Invoice->id)
                ->groupBy('patient_id', 'invoice_id')
                ->FIRST();
            $total_invoice = $account_patients->total_debit;
        }
        $patient_records = Treatment::where('invoice_id', $id)->orderBy('date', 'asc')->get();
        $patient_operations = Operation::where('invoice_id', $id)->orderBy('created_at', 'asc')->get();
        $patient_rays = RayService::where('invoice_id', $id)->get();
        $patient_Laboratories = LabService::where('invoice_id', $id)->get();
        $patient_medicines = $Invoice->Medicines()->get();
        return view('Dashboard.dashboard_patient.invoice_record', compact(
            'patient',
            'Invoice',
            'receipts',
            'patient_operations',
            'patient_rays',
            'patient_Laboratories',
            'account_patients',
            'total_invoice',
            'patient_medicines',
            'patient_records',
        ));
    }
    public function laboratoryInformation($id)
    {
        $laboratories  = LabService::findOrFail($id);
        return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratories'));
    }
    public function rayInformation($id)
    {
        $rays = RayService::findOrFail($id);
        return view('Dashboard.Doctor.invoices.view_rays', compact('rays'));
    }
}
