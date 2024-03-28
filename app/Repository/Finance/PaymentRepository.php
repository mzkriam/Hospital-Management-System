<?php


namespace App\Repository\Finance;

use App\Interfaces\Finance\PaymentRepositoryInterface;
use App\Models\FundAccount;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\PaymentAccount;
use Illuminate\Support\Facades\DB;

class PaymentRepository implements PaymentRepositoryInterface
{
    public function index()
    {
        $payments =  PaymentAccount::get();
        return view('Dashboard.Payment.index', compact('payments'));
    }
    public function create()
    {
        $Patients = Patient::get();
        return view('Dashboard.Payment.add', compact('Patients'));
    }
    public function show($id)
    {
        $payment_account = PaymentAccount::findOrFail($id);
        return view('Dashboard.Payment.print', compact('payment_account'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            // store receipt_accounts
            $payment_accounts = new PaymentAccount();
            $payment_accounts->date = date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->amount;
            $payment_accounts->description = $request->description;
            $payment_accounts->accountings_id = auth()->user()->id;
            $payment_accounts->save();
            // store fund_accounts
            $fund_accounts = new FundAccount();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->Payment_id = $payment_accounts->id;
            $fund_accounts->credit = $request->amount;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->save();
            // store patient_accounts
            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->Payment_id = $payment_accounts->id;
            $patient_accounts->Debit = $request->amount;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            DB::commit();
            session()->flash('add');
            return redirect()->route('Payment.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $payment_accounts = PaymentAccount::findOrFail($id);
        $Patients = Patient::get();
        return view('Dashboard.Payment.edit', compact('payment_accounts', 'Patients'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            // update PaymentAccount
            $payment_accounts = PaymentAccount::findOrFail($request->id);
            $payment_accounts->date = date('y-m-d');
            $payment_accounts->patient_id = $request->patient_id;
            $payment_accounts->amount = $request->amount;
            $payment_accounts->description = $request->description;
            $payment_accounts->save();
            // update fund_accounts
            $fund_accounts = FundAccount::where('Payment_id', $payment_accounts->id)->first();
            $fund_accounts->date = date('y-m-d');
            $fund_accounts->Payment_id = $payment_accounts->id;
            $fund_accounts->credit = $request->amount;
            $fund_accounts->Debit = 0.00;
            $fund_accounts->save();
            // update patient_accounts
            $patient_accounts = PatientAccount::where('Payment_id', $payment_accounts->id)->first();
            $patient_accounts->date = date('y-m-d');
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->Payment_id = $payment_accounts->id;
            $patient_accounts->Debit = $request->amount;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();
            DB::commit();
            session()->flash('edit');
            return redirect()->route('Payment.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            PaymentAccount::destroy($request->id);
            session()->flash('delete');
            return redirect()->back();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
