<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAccountingEmployeesRequest;
use App\Interfaces\AccountingEmployee\AccountingEmployeeRepositoryInterface;

class AccountingEmployeeController extends Controller
{
    private $accounting_employee;
    public function __construct(AccountingEmployeeRepositoryInterface $accounting_employee)
    {
        $this->accounting_employee = $accounting_employee;
    }
    public function index()
    {
        return $this->accounting_employee->index();
    }
    public function create()
    {
        return $this->accounting_employee->create();
    }
    public function store(StoreAccountingEmployeesRequest $request)
    {
        return $this->accounting_employee->store($request);
    }
    public function edit($id)
    {
        return $this->accounting_employee->edit($id);
    }
    public function update(StoreAccountingEmployeesRequest $request)
    {
        return $this->accounting_employee->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->accounting_employee->destroy($request);
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
        return $this->accounting_employee->update_password($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->accounting_employee->update_status($request);
    }





    public function showInvoices($id)
    {
        return $this->accounting_employee->showInvoices($id);
    }
    public function reviewInvoices($id)
    {
        return $this->accounting_employee->reviewInvoices($id);
    }
    public function completedInvoices($id)
    {
        return $this->accounting_employee->completedInvoices($id);
    }
    public function showRay($id)
    {
        return $this->accounting_employee->showRay($id);
    }
    public function showLaboratory($id)
    {
        return $this->accounting_employee->showLaboratory($id);
    }
    public function showPatientDoctor($id)
    {
        return $this->accounting_employee->showPatientDoctor($id);
    }
    public function showTreatment($id)
    {
        return $this->accounting_employee->showTreatment($id);
    }
    public function showAppointments($id)
    {
        return $this->accounting_employee->showAppointments($id);
    }
}
