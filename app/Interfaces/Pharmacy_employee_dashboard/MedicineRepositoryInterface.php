<?php

namespace App\Interfaces\Pharmacy_employee_dashboard;

interface MedicineRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
    public function update_status($request);
    public function treatmentMedicines();
    public function operationMedicines();
    public function patient_treatment_medicines($id);
    public function patient_operation_medicines($id);
    public function add_patient_operation_medicines($request);
    public function add_patient_treatment_medicines($request);
    public function viewNotification($id);
}
