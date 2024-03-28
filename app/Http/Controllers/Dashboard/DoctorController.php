<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDoctorsRequest;
use App\Interfaces\Doctors\DoctorRepositoryInterface;

class DoctorController extends Controller
{
    private $Doctors;
    public function __construct(DoctorRepositoryInterface $Doctors)
    {
        $this->Doctors = $Doctors;
    }
    public function index()
    {
        return $this->Doctors->index();
    }
    public function create()
    {
        return $this->Doctors->create();
    }
    public function store(StoreDoctorsRequest $request)
    {
        return $this->Doctors->store($request);
    }
    public function edit($id)
    {
        return $this->Doctors->edit($id);
    }
    public function update(StoreDoctorsRequest $request)
    {
        return $this->Doctors->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->Doctors->destroy($request);
    }
    public function update_password(Request $request)
    {
        $this->validate($request, [
            'password' => [
                'confirmed',
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'password_confirmation' => [
                'required',
                'string',
                'min:8',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
        ]);
        return $this->Doctors->update_password($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->Doctors->update_status($request);
    }

    public function showInvoices($id)
    {
        return $this->Doctors->showInvoices($id);
    }
    public function reviewInvoices($id)
    {
        return $this->Doctors->reviewInvoices($id);
    }
    public function completedInvoices($id)
    {
        return $this->Doctors->completedInvoices($id);
    }
    public function showRay($id)
    {
        return $this->Doctors->showRay($id);
    }
    public function showLaboratory($id)
    {
        return $this->Doctors->showLaboratory($id);
    }
    public function showPatientDoctor($id)
    {
        return $this->Doctors->showPatientDoctor($id);
    }
    public function showTreatment($id)
    {
        return $this->Doctors->showTreatment($id);
    }
    public function showOperation($id)
    {
        return $this->Doctors->showOperation($id);
    }
    public function showAppointments($id)
    {
        return $this->Doctors->showAppointments($id);
    }
}
