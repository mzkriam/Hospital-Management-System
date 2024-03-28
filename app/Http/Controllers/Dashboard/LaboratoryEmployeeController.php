<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaboratoryEmployee;
use App\Interfaces\LaboratoryEmployee\LaboratoryEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class LaboratoryEmployeeController extends Controller
{
    private $laboratory_employee;
    public function __construct(LaboratoryEmployeeRepositoryInterface $laboratory_employee)
    {
        $this->laboratory_employee = $laboratory_employee;
    }
    public function index()
    {
        return $this->laboratory_employee->index();
    }
    public function create()
    {
        return $this->laboratory_employee->create();
    }
    public function store(StoreLaboratoryEmployee $request)
    {
        return $this->laboratory_employee->store($request);
    }
    public function edit($id)
    {
        return $this->laboratory_employee->edit($id);
    }
    public function update(StoreLaboratoryEmployee $request)
    {
        return $this->laboratory_employee->update($request);
    }
    public function destroy($id)
    {
        return $this->laboratory_employee->destroy($id);
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
        return $this->laboratory_employee->update_password($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->laboratory_employee->update_status($request);
    }
    public function showAppointments($id)
    {
        return $this->laboratory_employee->showAppointments($id);
    }
}
