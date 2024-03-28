<?php

namespace App\Interfaces\Patients;

interface PatientRepositoryInterface
{
    public function index();
    public function appointments_patient($id);
    public function create();
    public function store($request);
    public function edit($id);
    public function update($request);
    public function destroy($request);
    public function update_password($request);
    public function update_status($request);
}
