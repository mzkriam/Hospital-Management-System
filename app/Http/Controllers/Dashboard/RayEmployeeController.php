<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRayEmployee;
use App\Interfaces\RayEmployee\RayEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class RayEmployeeController extends Controller
{
    private $employee;
    public function __construct(RayEmployeeRepositoryInterface $employee)
    {
        $this->employee = $employee;
    }

    public function index()
    {
        return $this->employee->index();
    }
    public function create()
    {
        return $this->employee->create();
    }

    public function store(StoreRayEmployee $request)
    {
        return $this->employee->store($request);
    }
    public function edit($id)
    {
        return $this->employee->edit($id);
    }
    public function update(StoreRayEmployee $request)
    {
        return $this->employee->update($request);
    }
    public function destroy($id)
    {
        return $this->employee->destroy($id);
    }
    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => [
                'confirmed',
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'password_confirmation' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ]);
        return $this->employee->update_password($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->employee->update_status($request);
    }
    public function showAppointments($id)
    {
        return $this->employee->showAppointments($id);
    }
}
