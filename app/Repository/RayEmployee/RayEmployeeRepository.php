<?php

namespace App\Repository\RayEmployee;

use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use App\Models\RayEmployee;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RayEmployeeRepository implements RayEmployeeRepositoryInterface
{
    public function index()
    {
        $ray_employees = RayEmployee::all();
        return view('Dashboard.ray_employee.index', compact('ray_employees'));
    }
    public function create()
    {
        return view('Dashboard.ray_employee.add');
    }
    public function store($request)
    {
        DB::beginTransaction();
        try {

            $ray_employee = new RayEmployee();
            $ray_employee->email = $request->email;
            $ray_employee->phone = $request->phone;
            $ray_employee->status = 1;
            $ray_employee->password = Hash::make($request->password);
            $ray_employee->save();

            $ray_employee->name = $request->name;
            $ray_employee->description = $request->description;
            $ray_employee->job_title = $request->job_title;
            $ray_employee->save();

            foreach ($request->schedules as $day => $times) {
                if ($times['start'] && $times['end']) {
                    $ray_employee->schedules()->create([
                        'day' => $day,
                        'start_time' => $times['start'],
                        'end_time' => $times['end'],
                    ]);
                }
            }
            DB::commit();
            session()->flash('add');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $ray_employee = RayEmployee::findOrFail($id);
        return view('Dashboard.ray_employee.edit', compact('ray_employee'));
    }
    public function update($request)
    {
        DB::beginTransaction();
        try {
            $ray_employee = RayEmployee::find($request->id);
            $ray_employee->email = $request->email;
            $ray_employee->phone = $request->phone;
            $ray_employee->save();

            $ray_employee->name = $request->name;
            $ray_employee->description = $request->description;
            $ray_employee->job_title = $request->job_title;
            $ray_employee->save();

            foreach ($request->schedules as $day => $times) {
                if (isset($times['cancel'])) {
                    $schedule = $ray_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        Schedule::destroy($schedule->id);
                    }
                } elseif ($times['start'] && $times['end']) {
                    $schedule = $ray_employee->schedules()->firstWhere('day', $day);
                    if ($schedule) {
                        $schedule->update([
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    } else {
                        $ray_employee->schedules()->create([
                            'day' => $day,
                            'start_time' => $times['start'],
                            'end_time' => $times['end'],
                        ]);
                    }
                }
            }
            DB::commit();
            session()->flash('edit');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($id)
    {
        try {
            RayEmployee::destroy($id);
            session()->flash('delete');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            RayEmployee::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            session()->flash('edit');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function  update_password($request)
    {
        try {
            RayEmployee::findOrFail($request->id)->update([
                'password' => Hash::make($request->password)
            ]);
            session()->flash('edit');
            return redirect()->route('ray_employee.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function showAppointments($id)
    {
        $doctor = RayEmployee::findOrFail($id);
        return view('Dashboard.Doctors.appointments', compact('doctor'));
    }
}
