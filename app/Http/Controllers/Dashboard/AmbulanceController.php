<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAmbulanceRequest;
use App\Interfaces\Ambulance\AmbulanceRepositoryInterface;

class AmbulanceController extends Controller
{
    private $ambulance;
    public function __construct(AmbulanceRepositoryInterface $ambulance)
    {
        $this->ambulance = $ambulance;
    }
    public function index()
    {
        return $this->ambulance->index();
    }
    public function create()
    {
        return $this->ambulance->create();
    }
    public function store(StoreAmbulanceRequest $request)
    {
        return $this->ambulance->store($request);
    }
    public function edit($id)
    {
        return $this->ambulance->edit($id);
    }
    public function update(StoreAmbulanceRequest $request)
    {
        return $this->ambulance->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->ambulance->destroy($request);
    }
}
