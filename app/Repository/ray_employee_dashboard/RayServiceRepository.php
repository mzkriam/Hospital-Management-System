<?php

namespace App\Repository\ray_employee_dashboard;

use App\Interfaces\ray_employee_dashboard\RayServiceRepositoryInterface;
use App\Models\RayService;
use App\Models\RayEmployee;

class RayServiceRepository implements RayServiceRepositoryInterface
{
    public function index()
    {
        $ray_services = RayService::get();
        $ray_employees = RayEmployee::get();
        return view('Dashboard.RayServices.index', compact('ray_services', 'ray_employees'));
    }
    public function store($request)
    {
        try {
            $ray_services = new RayService();
            $ray_services->price = $request->price;
            $ray_services->code = $request->code;
            $ray_services->ray_employ_id = $request->ray_employ_id;
            $ray_services->status = 1;
            $ray_services->save();
            $ray_services->description = $request->description;
            $ray_services->name = $request->name;
            $ray_services->save();
            session()->flash('add');
            return redirect()->route('ray_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        try {
            $ray_services = RayService::find($request->id);
            $ray_services->price = $request->price;
            $ray_services->code = $request->code;
            $ray_services->ray_employ_id = $request->ray_employ_id;
            $ray_services->save();
            $ray_services->description = $request->description;
            $ray_services->name = $request->name;
            $ray_services->save();
            session()->flash('edit');
            return redirect()->route('ray_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            $ray_services = RayService::find($request->id);
            RayService::destroy($ray_services->id);
            session()->flash('delete');
            return redirect()->route('ray_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            RayService::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            session()->flash('edit');
            return redirect()->route('ray_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
