<?php

namespace App\Repository\Ambulance;

use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;
use App\Models\Ambulance;
use GuzzleHttp\Psr7\Message;

class AmbulanceRepository implements AmbulanceRepositoryInterface
{
    public function index()
    {
        $ambulances = Ambulance::get();
        return view("Dashboard.Ambulance.index", compact("ambulances"));
    }
    public function create()
    {
        return view("Dashboard.Ambulance.create");
    }
    public function store($request)
    {
        try {
            $ambulances = new Ambulance();
            $ambulances->car_number = $request->car_number;
            $ambulances->car_model = $request->car_model;
            $ambulances->car_year_made = $request->car_year_made;
            $ambulances->driver_license_number = $request->driver_license_number;
            $ambulances->driver_phone = $request->driver_phone;
            $ambulances->is_available = 1;
            $ambulances->car_type = $request->car_type;
            $ambulances->save();
            $ambulances->driver_name = $request->driver_name;
            $ambulances->notes = $request->notes;
            $ambulances->save();
            session()->flash('add');
            return redirect()->route('Ambulance.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $ambulance = Ambulance::findOrFail($id);
        return view("Dashboard.Ambulance.edit", compact("ambulance"));
    }
    public function update($request)
    {
        try {
            $ambulance = Ambulance::findOrFail($request->id);
            $ambulance->update($request->all());
            $ambulance->driver_name = $request->driver_name;
            $ambulance->notes = $request->notes;
            $ambulance->save();
            session()->flash('edit');
            return redirect()->route('Ambulance.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        try {
            Ambulance::destroy($request->id);
            session()->flash('delete');
            return redirect()->route('Ambulance.index');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(["error" => $e->getMessage()]);
        }
    }
}
