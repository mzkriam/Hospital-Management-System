<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatientRequest;
use App\Interfaces\Patients\PatientRepositoryInterface;
use Illuminate\Http\Request;

class PatientController extends Controller
{

    private $Patient;

    public function __construct(PatientRepositoryInterface $Patient)
    {
        $this->Patient = $Patient;
    }

    public function index()
    {
        return $this->Patient->index();
    }
    public function appointments_patient($id)
    {
        return $this->Patient->appointments_patient($id);
    }

    public function create()
    {
        return $this->Patient->create();
    }

    public function store(StorePatientRequest $request)
    {
        return $this->Patient->store($request);
    }
    public function edit($id)
    {
        return $this->Patient->edit($id);
    }
    public function update(StorePatientRequest $request)
    {
        return $this->Patient->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->Patient->destroy($request);
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
        return $this->Patient->update_password($request);
    }
    public function update_status(Request $request)
    {
        $this->validate($request, [
            'status' => 'required|in:0,1'
        ]);
        return $this->Patient->update_status($request);
    }
}
