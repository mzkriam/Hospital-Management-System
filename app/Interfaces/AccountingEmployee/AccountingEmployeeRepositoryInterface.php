<?php

namespace App\Interfaces\AccountingEmployee;

interface AccountingEmployeeRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
    public function update_password($request);
    public function update_status($request);
    public function showInvoices($id);
    public function reviewInvoices($id);
    public function completedInvoices($id);
    public function showRay($id);
    public function showLaboratory($id);
    public function showPatientDoctor($id);
    public function showTreatment($id);
    public function showAppointments($id);
}
