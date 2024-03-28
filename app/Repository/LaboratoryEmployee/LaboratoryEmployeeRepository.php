<?php

namespace App\Repository\LaboratoryEmployee;

use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use App\Models\LabEmployee;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LaboratoryEmployeeRepository implements LaboratoryEmployeeRepositoryInterface
{
    public function index()
    {
        $laboratory_employees = LabEmployee::get();
        return view('Dashboard.laboratory_employee.index', compact('laboratory_employees'));
    }
    public function create()
    {
        return view('Dashboard.laboratory_employee.add');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $laboratory_employee = new LabEmployee();
            $laboratory_employee->email = $request->email;
            $laboratory_employee->phone = $request->phone;
            $laboratory_employee->status = 1;
            $laboratory_employee->password = Hash::make($request->password);
            $laboratory_employee->save();

            $laboratory_employee->name = $request->name;
            $laboratory_employee->description = $request->description;
            $laboratory_employee->job_title = $request->job_title;
            $laboratory_employee->save();

            foreach ($request->schedules as $day => $times) {
                if ($times['start'] && $times['end']) {
                    $laboratory_employee->schedules()->create([
                        'day' => $day,
                        'start_time' => $times['start'],
                        'end_time' => $times['end'],
                    ]);
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('laboratory_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $laboratory_employee = LabEmployee::findOrFail($id);
        return view('Dashboard.laboratory_employee.edit', compact('laboratory_employee'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $laboratory_employee = LabEmployee::find($request->id);
            $laboratory_employee->email = $request->email;
            $laboratory_employee->phone = $request->phone;
            $laboratory_employee->save();

            $laboratory_employee->name = $request->name;
            $laboratory_employee->description = $request->description;
            $laboratory_employee->job_title = $request->job_title;
            $laboratory_employee->save();

            foreach ($request->schedules as $day => $times) {
                if (isset($times['cancel'])) {
                    $schedule = $laboratory_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        Schedule::destroy($schedule->id);
                    }
                } elseif ($times['start'] && $times['end']) {
                    $schedule = $laboratory_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        $schedule->update([
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    } else {
                        $laboratory_employee->schedules()->create([
                            'day' => $day,
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    }
                }
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('laboratory_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            LabEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->route('laboratory_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            LabEmployee::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            session()->flash('edit');
            return redirect()->route('laboratory_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_password($request)
    {
        try {
            LabEmployee::findOrFail($request->id)->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('edit');

            return redirect()->route('laboratory_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function showAppointments($id)
    {
        $doctor = LabEmployee::findOrFail($id);
        return view('Dashboard.Doctors.appointments', compact('doctor'));
    }
}
