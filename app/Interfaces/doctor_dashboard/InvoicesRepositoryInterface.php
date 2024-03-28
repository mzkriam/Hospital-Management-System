<?php

namespace App\Interfaces\doctor_dashboard;

interface InvoicesRepositoryInterface
{
    public function index();
    public function show($id);
    public function completedInvoices();
    public function reviewInvoices();
    public function showPatientLaboratory($id);
}
