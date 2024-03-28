<?php

namespace App\Http\Controllers\Dashboard_Ray_Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\ray_employee_dashboard\InvoiceRayEmployeeRepositoryInterface;

class InvoiceRayEmployeeController extends Controller
{
    private $invoice_ray_employee;
    public function __construct(InvoiceRayEmployeeRepositoryInterface $InvoiceRayEmployeeInterface)
    {
        $this->invoice_ray_employee = $InvoiceRayEmployeeInterface;
    }
    public function index()
    {
        return $this->invoice_ray_employee->index();
    }
    public function completedRay()
    {
        return $this->invoice_ray_employee->completedRay();
    }
    public function edit($id)
    {
        return $this->invoice_ray_employee->edit($id);
    }
    public function update(Request $request, $id)
    {
        return $this->invoice_ray_employee->update($request, $id);
    }
    public function viewRay($id)
    {
        return $this->invoice_ray_employee->viewRay($id);
    }
    public function viewRequired($id)
    {
        return $this->invoice_ray_employee->viewRequired($id);
    }
    public function viewNotification($id)
    {
        return $this->invoice_ray_employee->viewNotification($id);
    }
}
