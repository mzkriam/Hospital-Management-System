<?php

namespace App\Interfaces\ray_employee_dashboard;

interface RayServiceRepositoryInterface
{
    public function index();
    public function store($request);
    public function update($request);
    public function destroy($request);
    public function update_status($request);
}
