<?php

namespace App\Interfaces\ray_employee_dashboard;

interface InvoiceRayEmployeeRepositoryInterface
{
    public function index();
    public function completedRay();
    public function edit($id);
    public function update($request, $id);
    public function viewRay($id);
    public function viewRequired($id);
    public function viewNotification($id);
}
