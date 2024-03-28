<?php

namespace App\Http\Controllers\Dashboard_Laboratory_Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLaboratoryServiceRequest;
use Illuminate\Http\Request;
use App\Interfaces\laboratory_employee_dashboard\LaboratoryServiceRepositoryInterface;

class LaboratoryServiceController extends Controller
{
    public $LaboratoryService;
    public function __construct(LaboratoryServiceRepositoryInterface $LaboratoryService)
    {
        $this->LaboratoryService = $LaboratoryService;
    }

    public function index()
    {
        return $this->LaboratoryService->index();
    }
    public function store(StoreLaboratoryServiceRequest $request)
    {

        return $this->LaboratoryService->store($request);
    }

    public function update(StoreLaboratoryServiceRequest $request)
    {
        return $this->LaboratoryService->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->LaboratoryService->destroy($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->LaboratoryService->update_status($request);
    }
}
