<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReceptionEmployee;
use App\Interfaces\ReceptionEmployee\ReceptionEmployeeRepositoryInterface;
use Illuminate\Http\Request;

class ReceptionEmployeeController extends Controller
{
    private $reception_employee;
    public function __construct(ReceptionEmployeeRepositoryInterface $reception_employee)
    {
        $this->reception_employee = $reception_employee;
    }
    public function index()
    {
        return $this->reception_employee->index();
    }
    public function create()
    {
        return $this->reception_employee->create();
    }
    public function store(StoreReceptionEmployee $request)
    {
        return $this->reception_employee->store($request);
    }
    public function edit($id)
    {
        return $this->reception_employee->edit($id);
    }
    public function update(StoreReceptionEmployee $request)
    {
        return $this->reception_employee->update($request);
    }
    public function destroy($id)
    {
        return $this->reception_employee->destroy($id);
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
        return $this->reception_employee->update_password($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->reception_employee->update_status($request);
    }
    public function showAppointments($id)
    {
        return $this->reception_employee->showAppointments($id);
    }
}
