<?php

namespace App\Repository\laboratory_employee_dashboard;

use App\Interfaces\laboratory_employee_dashboard\LaboratoryServiceRepositoryInterface;
use App\Models\LabService;
use App\Models\LabEmployee;

class LaboratoryServiceRepository implements LaboratoryServiceRepositoryInterface
{
    public function index()
    {
        $laboratory_services = LabService::get();
        $laboratory_employees = LabEmployee::get();
        return view('Dashboard.LaboratoryServices.index', compact('laboratory_services', 'laboratory_employees'));
    }
    public function store($request)
    {
        try {
            $lab_services = new LabService();
            $lab_services->price = $request->price;
            $lab_services->code = $request->code;
            $lab_services->lab_employ_id = $request->laboratory_employ_id;
            $lab_services->status = 1;
            $lab_services->save();
            $lab_services->description = $request->description;
            $lab_services->name = $request->name;
            $lab_services->save();
            session()->flash('add');
            return redirect()->route('laboratory_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update($request)
    {
        try {
            $lab_services = LabService::find($request->id);
            $lab_services->price = $request->price;
            $lab_services->code = $request->code;
            $lab_services->lab_employ_id = $request->laboratory_employ_id;
            $lab_services->save();
            $lab_services->description = $request->description;
            $lab_services->name = $request->name;
            $lab_services->save();
            session()->flash('edit');
            return redirect()->route('laboratory_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            $lab_services = LabService::find($request->id);
            LabService::destroy($lab_services->id);
            session()->flash('delete');
            return redirect()->route('laboratory_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function update_status($request)
    {
        try {
            LabService::findOrFail($request->id)->update([
                'status' => $request->status
            ]);
            session()->flash('edit');
            return redirect()->route('laboratory_service.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
