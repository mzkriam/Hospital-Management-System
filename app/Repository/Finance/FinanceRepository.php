<?php
//سند قبض
namespace App\Repository\Finance;

use App\Interfaces\Finance\FinanceRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\ReceiptAccount;
use Illuminate\Support\Facades\DB;

class FinanceRepository implements FinanceRepositoryInterface
{
    public function index()
    {
        $receipts =  ReceiptAccount::get();
        return view("Dashboard.Receipt.index", compact("receipts"));
    }
    public function show($id)
    {
        $receipt = ReceiptAccount::findOrFail($id);
        return view('Dashboard.Receipt.print', compact('receipt'));
    }
    public function store($request)
    {

        DB::beginTransaction();
        try {
            // store receipt_accounts
            $receipt_accounts = new ReceiptAccount();
            $receipt_accounts->date = date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->invoice_id = $request->invoice_id;
            $receipt_accounts->amount = $request->amount;
            if (auth('admin')->check()) {
                $receipt_accounts->accountings_id = NULL;
                $receipt_accounts->admin_id = auth()->user()->id;
            } else {
                $receipt_accounts->admin_id = NULL;
                $receipt_accounts->accountings_id = auth()->user()->id;
            }
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->Debit = $request->amount;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->invoice_id = $receipt_accounts->invoice_id;
            $patient_accounts->Debit = 0.00;
            $patient_accounts->credit = $request->amount;
            $patient_accounts->save();
            DB::commit();
            session()->flash('add');
            if (auth('admin')->check()) {
                return redirect()->route('admin_invoices_patient.index');
            } else {
                return redirect()->route('invoices_patient.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $receipt_accounts = ReceiptAccount::findOrFail($id);
        $invoice = Invoice::findOrFail($receipt_accounts->invoice_id);
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
        return view('Dashboard.Receipt.edit', compact('receipt_accounts', 'patient', 'invoice', 'account_patients'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            // store receipt_accounts
            $receipt_accounts = ReceiptAccount::findOrFail($request->id);
            $receipt_accounts->date = date('y-m-d');
            $receipt_accounts->patient_id = $request->patient_id;
            $receipt_accounts->invoice_id = $request->invoice_id;
            if (auth('admin')->check()) {
                $receipt_accounts->accountings_id = NULL;
                $receipt_accounts->admin_id = auth()->user()->id;
            } else {
                $receipt_accounts->admin_id = NULL;
                $receipt_accounts->accountings_id = auth()->user()->id;
            }
            $receipt_accounts->amount = $request->amount;
            $receipt_accounts->description = $request->description;
            $receipt_accounts->save();
            // store fund_accounts
            $fund_accounts = FundAccount::where('receipt_id', $request->id)->first();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->receipt_id = $receipt_accounts->id;
            $fund_accounts->Debit = $request->amount;
            $fund_accounts->credit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = PatientAccount::where('receipt_id', $request->id)->first();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->receipt_id = $receipt_accounts->id;
            $patient_accounts->invoice_id = $receipt_accounts->invoice_id;
            $patient_accounts->Debit = 0.00;
            $patient_accounts->credit = $request->amount;
            $patient_accounts->save();
            DB::commit();
            session()->flash('edit');
            if (auth('admin')->check()) {
                return redirect()->route('admin_Receipt.index');
            } else {
                return redirect()->route('Receipt.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            ReceiptAccount::destroy($request->id);
            session()->flash('delete');
            if (auth('admin')->check()) {
                return redirect()->route('admin_Receipt.index');
            } else {
                return redirect()->route('Receipt.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
