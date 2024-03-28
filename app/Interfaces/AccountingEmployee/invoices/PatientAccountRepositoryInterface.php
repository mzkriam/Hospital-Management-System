<?php

namespace  App\Interfaces\AccountingEmployee\invoices;

interface PatientAccountRepositoryInterface
{
    public function index();
    public function completedInvoice();
    public function ReceiptVoucher($id);
    public function showInvoice($id);
    public function show($id);
}
