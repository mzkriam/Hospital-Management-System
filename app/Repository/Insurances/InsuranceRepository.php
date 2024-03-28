<?php

namespace App\Repository\Insurances;

use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Models\Insurance;
use Illuminate\Support\Facades\DB;

class InsuranceRepository implements InsuranceRepositoryInterface
{
    public function index()
    {
        $insurances = Insurance::get();
        return view('Dashboard.Insurance.index', compact('insurances'));
    }
    public function create()
    {
        return view('Dashboard.insurance.create');
    }
    public function store($request)
    {
        try {
            $insurance = new Insurance();
            $insurance->company_rate = $request->company_rate;
            $insurance->discount_percentage = $request->discount_percentage;
            $insurance->contact_number = $request->contact_number;
            $insurance->insurance_code = $request->insurance_code;
            if (auth('admin')->check()) {
                $insurance->admin_id = auth()->user()->id;
            } else {
                $insurance->accountings_id = auth()->user()->id;
            }
            $insurance->status = 1;
            $insurance->save();
            $insurance->notes = $request->notes;
            $insurance->name = $request->name;
            $insurance->save();
            session()->flash('add');
            if (auth('admin')->check()) {
                return redirect()->route('adminInsurance.index');
            } else {
                return redirect()->route('Insurance.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function edit($id)
    {
        $insurances = Insurance::findOrFail($id);
        return view("Dashboard.Insurance.edit", compact("insurances"));
    }
    public function update($request)
    {
        try {
            $insurance = Insurance::findOrFail($request->id);
            $insurance->company_rate = $request->company_rate;
            $insurance->discount_percentage = $request->discount_percentage;
            $insurance->contact_number = $request->contact_number;
            $insurance->insurance_code = $request->insurance_code;
            if (auth('admin')->check()) {
                $insurance->admin_id = auth()->user()->id;
                $insurance->accountings_id = NULL;
            } else {
                $insurance->admin_id = NULL;
                $insurance->accountings_id = auth()->user()->id;
            }
            $insurance->save();
            $insurance->name = $request->name;
            $insurance->notes = $request->notes;
            $insurance->save();
            session()->flash('edit');
            if (auth('admin')->check()) {
                return redirect()->route('adminInsurance.index');
            } else {
                return redirect()->route('Insurance.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function destroy($request)
    {
        DB::transaction(function () use ($request) {
            DB::table('patients')
                ->where('insurance_id', $request->id)
                ->update(['insurance_id' => null]);
            Insurance::destroy($request->id);
        });

        session()->flash('delete');
        if (auth('admin')->check()) {
            return redirect()->route('adminInsurance.index');
        } else {
            return redirect()->route('Insurance.index');
        }
    }


    public function update_status($request)
    {
        try {
            $insurances = Insurance::findOrFail($request->id);
            if (auth('admin')->check()) {
                $insurances->accountings_id = NULL;
                $insurances->admin_id = auth()->user()->id;
                $insurances->status = $request->status;
                $insurances->save();
                session()->flash("edit");
                return redirect()->route('adminInsurance.index');
            } else {
                $insurances->admin_id = NULL;
                $insurances->accountings_id = auth()->user()->id;
                $insurances->status = $request->status;
                $insurances->save();
                session()->flash("edit");
                return redirect()->route('Insurance.index');
            }
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
