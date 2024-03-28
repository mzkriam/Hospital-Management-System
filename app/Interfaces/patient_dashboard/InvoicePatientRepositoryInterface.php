<?php

namespace App\Interfaces\patient_dashboard;

interface InvoicePatientRepositoryInterface
{
    public function invoices();
    public function showInvoice();
    public function laboratoryInformation($id);
    public function rayInformation($id);
}
