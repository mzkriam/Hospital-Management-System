<?php

namespace App\Repository\Operations;

use App\Events\CreateInvoice;
use App\Events\TransferToPharmacy;
use App\Interfaces\Operations\OperationRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Notification;
use App\Models\Operation;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Section;
use Illuminate\Support\Facades\DB;



class OperationRepository implements OperationRepositoryInterface
{
    public function index()
    {
        $operations = Operation::where('doctor_id', auth()->user()->id)->get();
        return view('Dashboard.Operations.index', compact('operations'));
    }
    public function add($id)
    {
        $doctors = Doctor::get();
        $medicines = Medicine::get();
        $sections = Section::get();
        $Patients = Patient::get();
        $invoice = Invoice::where('id', $id)->first();
        $invoice_id = $invoice->id;
        return view('Dashboard.Operations.add', compact('doctors', 'medicines', 'sections', 'Patients', 'invoice_id'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $operation = new Operation();
            $operation->price = $request->price;
            $operation->section_id = $request->section_id;
            $operation->patient_id = $request->patient_id;
            $operation->doctor_id = auth()->user()->id;
            $operation->invoice_id = $request->invoice_id;
            $operation->appointment = $request->appointment;
            $operation->save();

            $operation->results = $request->results;
            $operation->side_effects = $request->side_effects;
            $operation->warnings = $request->warnings;
            $operation->procedures = $request->procedures;
            $operation->description = $request->description;
            $operation->name = $request->name;
            $operation->save();

            if (is_array($request->doctors)) {
                foreach ($request->doctors as $doctor_id) {
                    if ($doctor_id) {
                        $doctor = Doctor::find($doctor_id);
                        $operation->doctors()->attach($doctor);
                    }
                }
            }
            if (is_array($request->medicines)) {
                foreach ($request->medicines as $medicine_id) {
                    if ($medicine_id) {
                        $medicine = Medicine::find($medicine_id);
                        $operation->medicines()->attach($medicine);
                    }
                }
            }
            $appointment = new  Appointment();
            $patient = Patient::findOrFail($request->patient_id);
            $appointment->method = 0;
            $appointment->type = 'certain';
            $appointment->patient_id = $request->patient_id;
            $appointment->section_id = $request->section_id;
            $appointment->doctor_id = $operation->doctor_id;
            $appointment->appointment = $request->appointment;
            $appointment->birth_patient = $patient->Date_Birth;
            $appointment->email = $patient->email;
            $appointment->insurance_id = $patient->insurance_id;
            $appointment->phone = $patient->Phone;
            $appointment->gender = $patient->Gender;
            $appointment->Blood_Group = $patient->Blood_Group;
            $appointment->Address = $patient->Address;
            $appointment->save();
            $appointment->notes = "Operations";
            $appointment->save();

            $patient_accounts = new PatientAccount();
            $patient_accounts->date = date('Y-m-d');
            $patient_accounts->operation_id = $operation->id;
            $patient_accounts->invoice_id = $operation->invoice_id;
            $patient_accounts->patient_id = $request->patient_id;
            $patient_accounts->Debit = $request->price;
            $patient_accounts->credit = 0.00;
            $patient_accounts->save();

            $notification_invoice = Notification::where('invoice_id', $operation->invoice_id)->where('user_id', auth()->user()->id)->first();
            if ($notification_invoice) {
                $notification_invoice->reader_status = true;
                $notification_invoice->save();
            }

            if (is_array($request->medicines)) {
                $notifications = new Notification();
                $notifications->invoice_id = $operation->invoice_id;
                $notifications->operation_id = $operation->id;
                $notifications->patient_id = $operation->patient_id;
                $notifications->section = 'operation';
                $notifications->message = "new operation examination: " . $patient->name;
                $notifications->save();

                $data = [
                    'patient' => $operation->patient_id,
                    'invoice_id' => $operation->invoice_id,
                    'operation_id' => $operation->id,
                    'notification_id' => $notifications->id,
                ];
                event(new TransferToPharmacy($data));
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $doctors = Doctor::get();
        $medicines = Medicine::get();
        $operation = Operation::findOrFail($id);
        $sections = Section::get();
        return view('Dashboard.Operations.edit', compact('operation', 'doctors', 'medicines', 'sections'));
    }
    public function update($request)
    {
        try {
            $operation = Operation::find($request->id);
            $patient = Patient::findOrFail($request->patient_id);
            $operation->price = $request->price;
            $operation->section_id = $request->section_id;
            $operation->save();

            $operation->results = $request->results;
            $operation->side_effects = $request->side_effects;
            $operation->warnings = $request->warnings;
            $operation->procedures = $request->procedures;
            $operation->description = $request->description;
            $operation->name = $request->name;
            $operation->save();

            $operation->doctors()->detach();
            if ($request->has('doctors')) {
                $operation->doctors()->attach($request->input('doctors', []));
            }

            $operation->medicines()->detach();
            if ($request->has('medicines')) {
                $operation->medicines()->attach($request->input('medicines', []));
            }

            $notification_invoice = Notification::where('invoice_id', $operation->invoice_id)->where('user_id', auth()->user()->id)->first();
            if ($notification_invoice) {
                $notification_invoice->reader_status = true;
                $notification_invoice->save();
            }

            if (is_array($request->medicines)) {
                $notifications = new Notification();
                $notifications->invoice_id = $operation->invoice_id;
                $notifications->operation_id = $operation->id;
                $notifications->patient_id = $operation->patient_id;
                $notifications->section = 'operation';
                $notifications->message = "new operation examination: " . $patient->name;
                $notifications->save();

                $data = [
                    'patient' => $operation->patient_id,
                    'invoice_id' => $operation->invoice_id,
                    'operation_id' => $operation->id,
                    'notification_id' => $notifications->id,
                ];
                event(new TransferToPharmacy($data));
            }

            session()->flash('edit');
            return redirect()->route('operation.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            Operation::destroy($id);
            session()->flash('delete');
            return redirect()->route('operation.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
