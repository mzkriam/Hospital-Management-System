<?php

namespace App\Interfaces\PharmacyEmployee;

interface PharmacyEmployeeRepositoryInterface
{
    public function index();
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($id);
    public function update_password($request);
    public function update_status($request);
    public function showAppointments($id);
}
