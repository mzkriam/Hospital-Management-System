<?php

namespace App\Http\Controllers\Dashboard_Ray_Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRayServiceRequest;
use Illuminate\Http\Request;
use App\Interfaces\ray_employee_dashboard\RayServiceRepositoryInterface;

class RayServiceController extends Controller
{
    public $rayService;
    public function __construct(RayServiceRepositoryInterface $rayService)
    {
        $this->rayService = $rayService;
    }

    public function index()
    {
        return $this->rayService->index();
    }
    public function store(StoreRayServiceRequest $request)
    {

        return $this->rayService->store($request);
    }

    public function update(StoreRayServiceRequest $request)
    {
        return $this->rayService->update($request);
    }

    public function destroy(Request $request)
    {
        return $this->rayService->destroy($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->rayService->update_status($request);
    }
}
