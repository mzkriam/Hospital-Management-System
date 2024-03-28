<?php

namespace App\Repository\ReceptionEmployee;

use App\Interfaces\ReceptionEmployee\ReceptionEmployeeRepositoryInterface;
use App\Models\Reception;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ReceptionEmployeeRepository implements ReceptionEmployeeRepositoryInterface
{
    public function index()
    {
        $reception_employees = Reception::get();
        return view('Dashboard.reception_employee.index', compact('reception_employees'));
    }
    public function create()
    {
        return view('Dashboard.reception_employee.add');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {
            $reception_employee = new Reception();
            $reception_employee->email = $request->email;
            $reception_employee->phone = $request->phone;
            $reception_employee->status = 1;
            $reception_employee->password = Hash::make($request->password);
            $reception_employee->save();

            $reception_employee->name = $request->name;
            $reception_employee->description = $request->description;
            $reception_employee->job_title = $request->job_title;
            $reception_employee->save();

            foreach ($request->schedules as $day => $times) {
                if ($times['start'] && $times['end']) {
                    $reception_employee->schedules()->create([
                        'day' => $day,
                        'start_time' => $times['start'],
                        'end_time' => $times['end'],
                    ]);
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('reception_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $reception_employee = Reception::findOrFail($id);
        return view('Dashboard.reception_employee.edit', compact('reception_employee'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $reception_employee = Reception::find($request->id);
            $reception_employee->email = $request->email;
            $reception_employee->phone = $request->phone;
            $reception_employee->save();

            $reception_employee->name = $request->name;
            $reception_employee->description = $request->description;
            $reception_employee->job_title = $request->job_title;
            $reception_employee->save();

            foreach ($request->schedules as $day => $times) {
                if (isset($times['cancel'])) {
                    $schedule = $reception_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        Schedule::destroy($schedule->id);
                    }
                } elseif ($times['start'] && $times['end']) {
                    $schedule = $reception_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        $schedule->update([
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    } else {
                        $reception_employee->schedules()->create([
                            'day' => $day,
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    }
                }
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('reception_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            Reception::destroy($id);
            session()->flash('delete');
            return redirect()->route('reception_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            Reception::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            session()->flash('edit');
            return redirect()->route('reception_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_password($request)
    {
        try {
            Reception::findOrFail($request->id)->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('edit');

            return redirect()->route('reception_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function showAppointments($id)
    {
        $doctor = Reception::findOrFail($id);
        return view('Dashboard.Doctors.appointments', compact('doctor'));
    }
}
