<?php

namespace App\Repository\PharmacyEmployee;

use App\Interfaces\PharmacyEmployee\PharmacyEmployeeRepositoryInterface;
use App\Models\PhaEmployee;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PharmacyEmployeeRepository implements PharmacyEmployeeRepositoryInterface
{
    public function index()
    {
        $pharmacy_employees = PhaEmployee::get();
        return view('Dashboard.pharmacy_employee.index', compact('pharmacy_employees'));
    }
    public function create()
    {
        return view('Dashboard.pharmacy_employee.add');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {

            $pharmacy_employee = new PhaEmployee();
            $pharmacy_employee->email = $request->email;
            $pharmacy_employee->phone = $request->phone;
            $pharmacy_employee->status = 1;
            $pharmacy_employee->password = Hash::make($request->password);
            $pharmacy_employee->save();

            $pharmacy_employee->name = $request->name;
            $pharmacy_employee->description = $request->description;
            $pharmacy_employee->job_title = $request->job_title;
            $pharmacy_employee->save();

            foreach ($request->schedules as $day => $times) {
                if ($times['start'] && $times['end']) {
                    $pharmacy_employee->schedules()->create([
                        'day' => $day,
                        'start_time' => $times['start'],
                        'end_time' => $times['end'],
                    ]);
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('pharmacy_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $pharmacy_employee = PhaEmployee::findOrFail($id);
        return view('Dashboard.pharmacy_employee.edit', compact('pharmacy_employee'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $pharmacy_employee = PhaEmployee::find($request->id);
            $pharmacy_employee->email = $request->email;
            $pharmacy_employee->phone = $request->phone;
            $pharmacy_employee->save();

            $pharmacy_employee->name = $request->name;
            $pharmacy_employee->description = $request->description;
            $pharmacy_employee->job_title = $request->job_title;
            $pharmacy_employee->save();

            foreach ($request->schedules as $day => $times) {
                if (isset($times['cancel'])) {
                    $schedule = $pharmacy_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        Schedule::destroy($schedule->id);
                    }
                } elseif ($times['start'] && $times['end']) {
                    $schedule = $pharmacy_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        $schedule->update([
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    } else {
                        $pharmacy_employee->schedules()->create([
                            'day' => $day,
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    }
                }
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('pharmacy_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            PhaEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->route('pharmacy_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_password($request)
    {
        try {
            PhaEmployee::findOrFail($request->id)->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('edit');
            return redirect()->route('pharmacy_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            PhaEmployee::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            session()->flash('edit');
            return redirect()->route('pharmacy_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function showAppointments($id)
    {
        $doctor = PhaEmployee::findOrFail($id);
        return view('Dashboard.Doctors.appointments', compact('doctor'));
    }
}
