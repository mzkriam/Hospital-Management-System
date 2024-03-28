<?php

namespace App\Interfaces\laboratory_employee_dashboard;

interface LaboratoryServiceRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
    public function update_status($request);
}
