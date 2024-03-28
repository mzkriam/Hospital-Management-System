<?php

namespace App\Http\Controllers\Dashboard_Pharmacy_Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMedicineRequest;
use Illuminate\Http\Request;
use App\Interfaces\Pharmacy_employee_dashboard\MedicineRepositoryInterface;

class MedicineController extends Controller
{
    public $medicine;
    public function __construct(MedicineRepositoryInterface $medicine)
    {
        $this->medicine = $medicine;
    }

    public function index()
    {
        return $this->medicine->index();
    }
    public function store(StoreMedicineRequest $request)
    {

        return $this->medicine->store($request);
    }

    public function update(StoreMedicineRequest $request)
    {
        return $this->medicine->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->medicine->destroy($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->medicine->update_status($request);
    }
    public function operationMedicines()
    {
        return $this->medicine->operationMedicines();
    }
    public function treatmentMedicines()
    {
        return $this->medicine->treatmentMedicines();
    }
    public function patient_operation_medicines($id)
    {
        return $this->medicine->patient_operation_medicines($id);
    }
    public function patient_treatment_medicines($id)
    {
        return $this->medicine->patient_treatment_medicines($id);
    }
    public function add_patient_operation_medicines(Request $request)
    {
        return $this->medicine->add_patient_operation_medicines($request);
    }
    public function add_patient_treatment_medicines(Request $request)
    {
        return $this->medicine->add_patient_treatment_medicines($request);
    }
    public function viewNotification($id)
    {
        return $this->medicine->viewNotification($id);
    }
}
