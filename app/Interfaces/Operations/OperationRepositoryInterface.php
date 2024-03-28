<?php

namespace App\Interfaces\Operations;

interface OperationRepositoryInterface
{
    public function index();
    public function add($id);
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($id);
}
