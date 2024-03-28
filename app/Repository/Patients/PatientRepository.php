<?php


namespace App\Repository\Patients;

use App\Interfaces\Patients\PatientRepositoryInterface;
use App\Models\Patient;
use App\Models\Insurance;
use App\Models\Appointment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PatientRepository implements PatientRepositoryInterface
{
    public function index()
    {
        $Patients = Patient::all();
        return view('Dashboard.Patients.index', compact('Patients'));
    }
    public function appointments_patient($id)
    {
        $Patient = patient::findOrFail($id);
        return view('Dashboard.Patients.appointments_patient', compact('Patient'));
    }
    public function create()
    {
        $insurances = Insurance::get();
        return view('Dashboard.Patients.create', compact('insurances'));
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $Patients = new Patient();
            $Patients->email = $request->email;
            $Patients->password = Hash::make($request->Phone);
            $Patients->Date_Birth = $request->Date_Birth;
            $Patients->Phone = $request->Phone;
            $Patients->Gender = $request->Gender;
            if (auth('admin')->check()) {
                $Patients->admin_id = auth()->user()->id;
            } else {
                $Patients->reception_id = auth()->user()->id;
            }
            $Patients->Blood_Group = $request->Blood_Group;
            $Patients->insurance_id = $request->insurance_id;
            $Patients->status = 1;
            $Patients->save();
            $Patients->name = $request->name;
            $Patients->Address = $request->Address;
            $Patients->save();
            if ($request->id) {
                $appointment = Appointment::findOrFail($request->id);
                $appointment->patient_id = $Patients->id;
                $appointment->reception_id = auth()->user()->id;
                $appointment->save();
            }
            DB::commit();
            session()->flash('add');
            if (auth('admin')->check()) {
                return redirect()->route('adminPatients.index');
            } else {
                return redirect()->route('Patients.index');
            }
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $insurances = Insurance::get();
        $Patient = Patient::findOrFail($id);
        return view('Dashboard.Patients.edit', compact('Patient', 'insurances'));
    }
    public function update($request)
    {
        $Patients = Patient::findOrFail($request->id);
        $Patients->email = $request->email;
        $Patients->Date_Birth = $request->Date_Birth;
        if (auth('admin')->check()) {
            $Patients->admin_id = auth()->user()->id;
            $Patients->reception_id = Null;
        } else {
            $Patients->reception_id = auth()->user()->id;
            $Patients->admin_id = Null;
        }
        $Patients->Phone = $request->Phone;
        $Patients->Gender = $request->Gender;
        $Patients->Blood_Group = $request->Blood_Group;
        $Patients->insurance_id = $request->insurance_id;
        $Patients->save();
        $Patients->name = $request->name;
        $Patients->Address = $request->Address;
        $Patients->save();
        session()->flash('edit');
        if (auth('admin')->check()) {
            return redirect()->route('adminPatients.index');
        } else {
            return redirect()->route('Patients.index');
        }
    }
    public function destroy($request)
    {
        Patient::destroy($request->id);
        session()->flash('delete');
        if (auth('admin')->check()) {
            return redirect()->route('adminPatients.index');
        } else {
            return redirect()->route('Patients.index');
        }
    }
    public function update_password($request)
    {
        try {
            $Patients = Patient::findOrFail($request->id);
            if (auth('admin')->check()) {
                $Patients->password = Hash::make($request->password);
                $Patients->admin_id = auth()->user()->id;
                $Patients->reception_id = Null;
                $Patients->save();
                session()->flash("edit");
                return redirect()->route('adminPatients.index');
            } else {
                $Patients->password = Hash::make($request->password);
                $Patients->reception_id = auth()->user()->id;
                $Patients->admin_id = Null;
                $Patients->save();
                session()->flash("edit");
                return redirect()->route('Patients.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            $Patients = Patient::findOrFail($request->id);
            if (auth('admin')->check()) {
                $Patients->status = $request->status;
                $Patients->admin_id = auth()->user()->id;
                $Patients->reception_id = Null;
                $Patients->save();
                session()->flash("edit");
                return redirect()->route('adminPatients.index');
            } else {
                $Patients->status = $request->status;
                $Patients->reception_id = auth()->user()->id;
                $Patients->admin_id = Null;
                $Patients->save();
                session()->flash("edit");
                return redirect()->route('Patients.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
