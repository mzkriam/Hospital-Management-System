<?php

namespace App\Repository\AccountingEmployee\invoices;

use App\Interfaces\AccountingEmployee\invoices\PatientAccountRepositoryInterface;
use App\Models\Patient;
use App\Models\Operation;
use App\Models\Treatment;
use App\Models\RayService;
use App\Models\LabService;
use App\Models\Invoice;
use App\Models\ReceiptAccount;
use App\Models\PatientAccount;
use Illuminate\Support\Facades\DB;

class PatientAccountRepository implements PatientAccountRepositoryInterface
{
    public function index()
    {
        $c = 0;
        $account_patients = PatientAccount::select(
            'patient_id',
            'invoice_id',
            DB::raw('sum(Debit) as total_debit'),
            DB::raw('sum(credit) as total_credit')
        )
            ->groupBy('patient_id', 'invoice_id')
            ->havingRaw('sum(Debit) > sum(credit)')
            ->havingRaw('invoice_id IS NOT NULL')
            ->get();

        return view('Dashboard.dashboard_accounting_employee.invoices.index', compact('account_patients', 'c'));
    }
    public function completedInvoice()
    {
        $c = 1;
        $account_patients = PatientAccount::select(
            'patient_id',
            'invoice_id',
            DB::raw('sum(Debit) as total_debit'),
            DB::raw('sum(credit) as total_credit')
        )
            ->groupBy('patient_id', 'invoice_id')
            ->havingRaw('sum(Debit) = sum(credit)')
            ->havingRaw('invoice_id IS NOT NULL')
            ->get();

        return view('Dashboard.dashboard_accounting_employee.invoices.index', compact('account_patients', 'c'));
    }
    public function ReceiptVoucher($id)
    {
        $invoice = Invoice::findOrFail($id);
        $patient = Patient::where('id', $invoice->patient_id)->first();
        $account_patients = PatientAccount::select(
            'patient_id',
            'invoice_id',
            DB::raw('sum(Debit) as total_debit'),
            DB::raw('sum(credit) as total_credit')
        )
            ->where('patient_id', $patient->id)
            ->where('invoice_id', $invoice->id)
            ->groupBy('patient_id', 'invoice_id')
            ->FIRST();
        return view('Dashboard.Receipt.add', compact('account_patients'));
    }
    public function showInvoice($id)
    {
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
        return view('Dashboard.dashboard_accounting_employee.invoices.invoice_record', compact(
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
    public function show($id)
    {
        $patient = Patient::FindOrFail($id);
        $patient_medicines = $patient->Medicines()->get();
        $Invoices = Invoice::where('patient_id', $id)->get();
        $receipts = ReceiptAccount::where('patient_id', $id)->get();
        $patient_operations = Operation::where('patient_id', $id)->orderBy('created_at', 'asc')->get();
        $patient_rays = RayService::where('patient_id', $id)->get();
        $patient_Laboratories = LabService::where('patient_id', $id)->get();
        $patient_records = Treatment::where('invoice_id', $id)->orderBy('date', 'asc')->get();

        return view('Dashboard.dashboard_accounting_employee.invoices.patient_record', compact(
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
}
