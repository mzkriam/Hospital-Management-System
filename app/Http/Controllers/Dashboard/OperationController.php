<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOperationRequest;
use App\Interfaces\Operations\OperationRepositoryInterface;

class OperationController extends Controller
{
    private $operation;
    public function __construct(OperationRepositoryInterface $operation)
    {
        $this->operation = $operation;
    }

    public function index()
    {
        return $this->operation->index();
    }
    public function add($id)
    {
        return $this->operation->add($id);
    }

    public function store(StoreOperationRequest $request)
    {
        return $this->operation->store($request);
    }
    public function edit($id)
    {
        return $this->operation->edit($id);
    }
    public function update(StoreOperationRequest $request)
    {
        return $this->operation->update($request);
    }
    public function destroy($id)
    {
        return $this->operation->destroy($id);
    }
}
