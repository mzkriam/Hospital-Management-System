<?php

namespace App\Http\Controllers\Dashboard_Patient;

use App\Http\Controllers\Controller;
use App\Interfaces\patient_dashboard\InvoicePatientRepositoryInterface;

class InvoicePatientController extends Controller
{
    private $invoice_patient;
    public function __construct(InvoicePatientRepositoryInterface $invoice_patient)
    {
        $this->invoice_patient = $invoice_patient;
    }
    public function invoices()
    {
        return $this->invoice_patient->invoices();
    }
    public function showInvoice()
    {
        return $this->invoice_patient->showInvoice();
    }
    public function laboratoryInformation($id)
    {
        return $this->invoice_patient->laboratoryInformation($id);
    }
    public function rayInformation($id)
    {
        return $this->invoice_patient->rayInformation($id);
    }
}
