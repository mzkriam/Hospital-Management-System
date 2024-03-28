<?php

namespace App\Http\Controllers\Dashboard_Laboratory_Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\laboratory_employee_dashboard\InvoiceLaboratoryEmployeeRepositoryInterface;

class InvoiceLaboratoryEmployeeController extends Controller
{
    private $invoice_laboratory_employee;
    public function __construct(InvoiceLaboratoryEmployeeRepositoryInterface $InvoiceRayEmployeeInterface)
    {
        $this->invoice_laboratory_employee = $InvoiceRayEmployeeInterface;
    }
    public function index()
    {
        return $this->invoice_laboratory_employee->index();
    }
    public function completedInvoicesLaboratoryEmployee()
    {
        return $this->invoice_laboratory_employee->completedInvoicesLaboratoryEmployee();
    }
    public function edit($id)
    {
        return $this->invoice_laboratory_employee->edit($id);
    }
    public function update(Request $request, $id)
    {
        return $this->invoice_laboratory_employee->update($request, $id);
    }
    public function viewLaboratory($id)
    {
        return $this->invoice_laboratory_employee->viewLaboratory($id);
    }
    public function viewRequired($id)
    {
        return $this->invoice_laboratory_employee->viewRequired($id);
    }
    public function viewNotification($id)
    {
        return $this->invoice_laboratory_employee->viewNotification($id);
    }
}
