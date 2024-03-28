<?php

namespace App\Interfaces\laboratory_employee_dashboard;

interface InvoiceLaboratoryEmployeeRepositoryInterface
{
    public function index();
    public function completedInvoicesLaboratoryEmployee();
    public function edit($id);
    public function update($request, $id);
    public function viewLaboratory($id);
    public function viewRequired($id);
    public function viewNotification($id);
}
