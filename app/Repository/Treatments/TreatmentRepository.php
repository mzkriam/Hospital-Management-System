<?php

namespace App\Repository\Treatments;

use App\Events\TransferToPharmacy;
use App\Interfaces\Treatments\TreatmentRepositoryInterface;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Invoice;
use App\Models\Medicine;
use App\Models\Notification;
use App\Models\Operation;
use App\Models\Patient;
use App\Models\Section;
use App\Models\Treatment;
use Illuminate\Support\Facades\DB;



class TreatmentRepository implements TreatmentRepositoryInterface
{
    public function index()
    {
        $treatments = Treatment::where('doctor_id', auth()->user()->id)->get();
        return view('Dashboard.Treatments.index', compact('treatments'));
    }
    public function add($id)
    {
        $doctors = Doctor::get();
        $medicines = Medicine::get();
        $sections = Section::get();
        $invoice = Invoice::findOrFail($id);
        $doctor_id = auth()->user()->id;
        $invoice_id = $invoice->id;
        $patient_id = $invoice->patient_id;
        return view('Dashboard.Treatments.add', compact('doctors', 'medicines', 'sections', 'invoice_id', 'patient_id', 'doctor_id'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $this->invoice_status($request->invoice_id, 3);
            $treatment = new Treatment();
            $treatment->date = date('Y-m-d');
            $treatment->invoice_id = $request->invoice_id;
            $treatment->doctor_id = auth()->user()->id;
            $treatment->patient_id = $request->patient_id;
            $treatment->save();

            $treatment->results = $request->results;
            $treatment->side_effects = $request->side_effects;
            $treatment->warnings = $request->warnings;
            $treatment->procedures = $request->procedures;
            $treatment->description = $request->description;
            $treatment->name = $request->name;
            $treatment->save();

            if (is_array($request->medicines)) {
                foreach ($request->medicines as $medicine_id) {
                    if ($medicine_id) {
                        $medicine = Medicine::find($medicine_id);
                        $treatment->medicines()->attach($medicine);
                    }
                }
            }

            $notification_invoice = Notification::where('invoice_id', $treatment->invoice_id)->where('user_id', auth()->user()->id)->first();
            if ($notification_invoice) {
                $notification_invoice->reader_status = true;
                $notification_invoice->save();
            }

            if (is_array($request->medicines)) {
                $patient = Patient::find($request->patient_id);
                $notifications = new Notification();
                $notifications->invoice_id = $treatment->invoice_id;
                $notifications->treatment_id = $treatment->id;
                $notifications->patient_id = $treatment->patient_id;
                $notifications->section = 'treatment';
                $notifications->message = "new treatment examination: " . $patient->name;
                $notifications->save();

                // $data = [
                //     'patient' => $treatment->patient_id,
                //     'invoice_id' => $treatment->invoice_id,
                //     'treatment_id' => $treatment->id,
                //     'notification_id' => $notifications->id,
                // ];
                // event(new TransferToPharmacy($data));
            }

            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function add_a_review($id)
    {
        $doctors = Doctor::get();
        $medicines = Medicine::get();
        $sections = Section::get();
        $invoice = Invoice::findOrFail($id);
        $doctor_id = auth()->user()->id;
        $invoice_id = $invoice->id;
        $patient_id = $invoice->patient_id;
        return view('Dashboard.Treatments.addReview', compact('doctors', 'medicines', 'sections', 'invoice_id', 'patient_id', 'doctor_id'));
    }
    public function storeReview($request)
    {
        DB::beginTransaction();
        try {
            $this->invoice_status($request->invoice_id, 2);
            $treatment = new Treatment();
            $treatment->date = date('Y-m-d');
            $treatment->review_date = $request->review_date;
            $treatment->invoice_id = $request->invoice_id;
            $treatment->doctor_id = auth()->user()->id;
            $treatment->patient_id = $request->patient_id;
            $treatment->save();

            $treatment->results = $request->results;
            $treatment->side_effects = $request->side_effects;
            $treatment->warnings = $request->warnings;
            $treatment->procedures = $request->procedures;
            $treatment->description = $request->description;
            $treatment->name = $request->name;
            $treatment->save();

            if (is_array($request->medicines)) {
                foreach ($request->medicines as $medicine_id) {
                    if ($medicine_id) {
                        $medicine = Medicine::find($medicine_id);
                        $treatment->medicines()->attach($medicine);
                    }
                }
            }

            $patient = Patient::find($request->patient_id);
            $appointment = new  Appointment();
            $appointment->method = 0;
            $appointment->type = 'certain';
            $appointment->patient_id = $request->patient_id;
            $appointment->section_id = auth()->user()->section->id;
            $appointment->doctor_id = auth()->user()->id;
            $appointment->appointment = $request->review_date;
            $appointment->email = $patient->email;
            $appointment->insurance_id = $patient->insurance_id;
            $appointment->phone = $patient->phone;
            $appointment->gender = $patient->gender;
            $appointment->Blood_Group = $patient->Blood_Group;
            $appointment->save();
            $appointment->notes = "Review";
            $appointment->save();

            $notification_invoice = Notification::where('invoice_id', $treatment->invoice_id)->where('user_id', auth()->user()->id)->first();
            if ($notification_invoice) {
                $notification_invoice->reader_status = true;
                $notification_invoice->save();
            }

            if (is_array($request->medicines)) {
                $notifications = new Notification();
                $notifications->invoice_id = $treatment->invoice_id;
                $notifications->treatment_id = $treatment->id;
                $notifications->patient_id = $treatment->patient_id;
                $notifications->section = 'treatment';
                $notifications->message = "new treatment examination: " . $patient->name;
                $notifications->save();

                // $data = [
                //     'patient' => $treatment->patient_id,
                //     'invoice_id' => $treatment->invoice_id,
                //     'treatment_id' => $treatment->id,
                //     'notification_id' => $notifications->id,
                // ];
                // event(new TransferToPharmacy($data));
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('invoices.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function show($id)
    {
        $patient_records = Treatment::where('patient_id', $id)->orderBy('date', 'asc')->get();
        $patient_operations = Operation::where('patient_id', $id)->orderBy('created_at', 'asc')->get();
        $patient = Patient::FindOrFail($id);
        return view('Dashboard.Doctor.invoices.patient_record', compact('patient', 'patient_records', 'patient_operations'));
    }
    public function destroy($id)
    {
        try {
            Treatment::destroy($id);
            session()->flash('delete');
            return redirect()->route('treatment.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function invoice_status($invoice_id, $id_status)
    {
        $invoice_status = Invoice::findOrFail($invoice_id);
        $invoice_status->update([
            'invoice_status' => $id_status
        ]);
    }
}
