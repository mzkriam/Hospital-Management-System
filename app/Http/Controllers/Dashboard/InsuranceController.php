<?php

namespace App\Http\Controllers\Dashboard;

use App\Interfaces\Insurances\InsuranceRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreInsuranceRequest;

class InsuranceController extends Controller
{
    private $insurances;
    public function __construct(InsuranceRepositoryInterface $insurances)
    {
        $this->insurances = $insurances;
    }
    public function index()
    {
        return $this->insurances->index();
    }
    public function create()
    {
        return $this->insurances->create();
    }
    public function store(StoreInsuranceRequest $request)
    {
        return $this->insurances->store($request);
    }
    public function edit($id)
    {
        return $this->insurances->edit($id);
    }
    public function update(StoreInsuranceRequest $request)
    {
        return $this->insurances->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->insurances->destroy($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->insurances->update_status($request);
    }
}
