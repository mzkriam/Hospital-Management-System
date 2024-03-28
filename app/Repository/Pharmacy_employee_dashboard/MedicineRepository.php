<?php

namespace App\Repository\Pharmacy_employee_dashboard;

use App\Interfaces\Pharmacy_employee_dashboard\MedicineRepositoryInterface;
use App\Models\phaEmployee;
use App\Models\Medicine;
use App\Models\Treatment;
use App\Models\Operation;
use App\Models\Invoice;
use App\Models\Notification;
use App\Models\Patient;
use Illuminate\Support\Facades\DB;
use App\Models\PatientAccount;

class MedicineRepository implements MedicineRepositoryInterface
{
    public function index()
    {
        $medicines = Medicine::get();
        $pha_employees = phaEmployee::get();
        return view('Dashboard.Medicines.index', compact('medicines', 'pha_employees'));
    }
    public function store($request)
    {
        try {
            $medicine = new Medicine();
            $medicine->price = $request->price;
            $medicine->code = $request->code;
            if (auth('admin')->check()) {
                $medicine->admin_id = auth()->user()->id;
                $medicine->pha_employee_id = NULL;
            } else {
                $medicine->pha_employee_id = auth()->user()->id;
                $medicine->admin_id = NULL;
            }
            $medicine->status = 1;
            $medicine->save();
            $medicine->description = $request->description;
            $medicine->name = $request->name;
            $medicine->save();
            session()->flash('add');
            if (auth('admin')->check()) {
                return redirect()->route('admin_medicine.index');
            } else {
                return redirect()->route('medicine.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        try {
            $medicine = Medicine::find($request->id);
            $medicine->price = $request->price;
            $medicine->code = $request->code;
            if (auth('admin')->check()) {
                $medicine->admin_id = auth()->user()->id;
                $medicine->pha_employee_id = NULL;
            } else {
                $medicine->pha_employee_id = auth()->user()->id;
                $medicine->admin_id = NULL;
            }
            $medicine->save();
            $medicine->description = $request->description;
            $medicine->name = $request->name;
            $medicine->save();
            session()->flash('edit');
            if (auth('admin')->check()) {
                return redirect()->route('admin_medicine.index');
            } else {
                return redirect()->route('medicine.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            $medicine = Medicine::find($request->id);
            Medicine::destroy($medicine->id);
            session()->flash('delete');
            if (auth('admin')->check()) {
                return redirect()->route('admin_medicine.index');
            } else {
                return redirect()->route('medicine.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            $medicine = Medicine::findOrFail($request->id);
            $medicine = Medicine::findOrFail($request->id);
            if (auth('admin')->check()) {
                $medicine->admin_id = auth()->user()->id;
                $medicine->status = $request->status;
                $medicine->pha_employee_id = NULL;
                $medicine->save();
            } else {
                $medicine->pha_employee_id = auth()->user()->id;
                $medicine->status = $request->status;
                $medicine->admin_id = NULL;
                $medicine->save();
            }
            session()->flash('edit');
            if (auth('admin')->check()) {
                return redirect()->route('admin_medicine.index');
            } else {
                return redirect()->route('medicine.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function treatmentMedicines()
    {
        $treatments = Treatment::where('status_medicine', 0)->whereHas('Medicines')->get();
        return view('Dashboard.dashboard_Pharmacy_employee.invoices.treatments_medicines', compact('treatments'));
    }

    public function operationMedicines()
    {
        $operations = Operation::where('status_medicine', 0)->whereHas('Medicines')->get();
        return view('Dashboard.dashboard_Pharmacy_employee.invoices.operations_medicines', compact('operations'));
    }
    public function patient_treatment_medicines($id)
    {
        $treatment = Treatment::findOrFail($id);
        $medicines = Treatment::findOrFail($id)->Medicines;
        $notification = Notification::where('treatment_id', $treatment->id)->first();
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        return view('Dashboard.dashboard_Pharmacy_employee.invoices.add_medicines_treatment', compact('medicines', 'treatment'));
    }
    public function add_patient_treatment_medicines($request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        if (is_array($request->medicines)) {
            DB::beginTransaction();
            $price_medicines = 0;
            try {
                foreach ($request->medicines as $medicine_id) {
                    if ($medicine_id) {
                        $medicine = Medicine::find($medicine_id);
                        $patient = Patient::find($request->patient_id);
                        $price_medicines = $price_medicines + $medicine->price;
                        $invoice->Medicines()->attach($medicine);
                        $patient->Medicines()->attach($medicine);
                    }
                }
                $treatment = Treatment::findOrFail($request->treatment_id);
                $treatment->status_medicine = 1;
                $treatment->save();
                $patient_accounts = new PatientAccount();
                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->invoice_id = $invoice->id;
                $patient_accounts->patient_id = $invoice->patient_id;
                $patient_accounts->Debit = $price_medicines;
                $patient_accounts->credit = 0.00;
                $patient_accounts->save();
                DB::commit();
                session()->flash('add');
                return redirect()->route('treatment.medicines');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    public function patient_operation_medicines($id)
    {
        $operation = Operation::findOrFail($id);
        $medicines = Operation::findOrFail($id)->Medicines;
        $notification = Notification::where('operation_id', $operation->id)->first();
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
        }
        return view('Dashboard.dashboard_Pharmacy_employee.invoices.add_medicines_operation', compact('medicines', 'operation'));
    }
    public function add_patient_operation_medicines($request)
    {
        $invoice = Invoice::findOrFail($request->invoice_id);
        if (is_array($request->medicines)) {
            DB::beginTransaction();
            $price_medicines = 0;
            try {
                foreach ($request->medicines as $medicine_id) {
                    if ($medicine_id) {
                        $medicine = Medicine::find($medicine_id);
                        $patient = Patient::find($request->patient_id);
                        $price_medicines = $price_medicines + $medicine->price;
                        $invoice->medicines()->attach($medicine);
                        $patient->Medicines()->attach($medicine);
                    }
                }
                $operation = Operation::findOrFail($request->operation_id);
                $operation->status_medicine = 1;
                $operation->save();
                $patient_accounts = new PatientAccount();
                $patient_accounts->date = date('Y-m-d');
                $patient_accounts->invoice_id = $invoice->id;
                $patient_accounts->patient_id = $invoice->patient_id;
                $patient_accounts->Debit = $price_medicines;
                $patient_accounts->credit = 0.00;
                $patient_accounts->save();
                DB::commit();
                session()->flash('add');
                return redirect()->route('operation.medicines');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->withErrors(['error' => $e->getMessage()]);
            }
        }
    }
    public function viewNotification($id)
    {
        $notification = Notification::findOrFail($id);
        if ($notification) {
            $notification->reader_status = true;
            $notification->save();
            if ($notification->treatment_id) {
                $treatment = Treatment::findOrFail($notification->treatment_id);
                $medicines = Treatment::findOrFail($notification->treatment_id)->Medicines;
                return view('Dashboard.dashboard_Pharmacy_employee.invoices.add_medicines_treatment', compact('medicines', 'treatment'));
            } elseif ($notification->operation_id) {
                $operation = Operation::findOrFail($notification->operation_id);
                $medicines = Operation::findOrFail($notification->operation_id)->Medicines;
                return view('Dashboard.dashboard_Pharmacy_employee.invoices.add_medicines_operation', compact('medicines', 'operation'));
            }
        }
    }
}
