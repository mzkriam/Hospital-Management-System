<?php

namespace App\Http\Controllers\Dashboard_Accounting_Employee;

use App\Http\Controllers\Controller;
use App\Interfaces\AccountingEmployee\invoices\PatientAccountRepositoryInterface;
use Illuminate\Http\Request;

class PatientAccountController extends Controller
{
    public $patientAccount;
    public function __construct(PatientAccountRepositoryInterface $patientAccount)
    {
        $this->patientAccount = $patientAccount;
    }
    public function index()
    {
        return $this->patientAccount->index();
    }
    public function completedInvoice()
    {
        return $this->patientAccount->completedInvoice();
    }
    public function create()
    {
        //
    }
    public function store(Request $request)
    {
    }
    public function ReceiptVoucher($id)
    {
        return $this->patientAccount->ReceiptVoucher($id);
    }
    public function showInvoice($id)
    {
        return $this->patientAccount->showInvoice($id);
    }
    public function show($id)
    {
        return $this->patientAccount->show($id);
    }


    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
