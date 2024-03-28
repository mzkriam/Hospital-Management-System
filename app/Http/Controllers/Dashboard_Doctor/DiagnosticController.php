<?php

namespace App\Http\Controllers\Dashboard_Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\doctor_dashboard\DiagnosisRepositoryInterface;

class DiagnosticController extends Controller
{
    private $Diagnosis;
    public function __construct(DiagnosisRepositoryInterface $Diagnosis)
    {
        $this->Diagnosis = $Diagnosis;
    }
    public function store(Request $request)
    {
        return $this->Diagnosis->store($request);
    }
    public function show($id)
    {
        return $this->Diagnosis->show($id);
    }
    public function addReview(Request $request)
    {
        return $this->Diagnosis->addReview($request);
    }
}
