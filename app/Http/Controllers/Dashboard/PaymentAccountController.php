<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Interfaces\Finance\PaymentRepositoryInterface;

class PaymentAccountController extends Controller
{
    private $payment;
    public function __construct(PaymentRepositoryInterface $payment)
    {
        $this->payment = $payment;
    }
    public function index()
    {
        return $this->payment->index();
    }
    public function show($id)
    {
        return $this->payment->show($id);
    }
    public function create()
    {
        return $this->payment->create();
    }
    public function store(Request $request)
    {
        return $this->payment->store($request);
    }
    public function edit($id)
    {
        return $this->payment->edit($id);
    }
    public function update(Request $request)
    {
        return $this->payment->update($request);
    }
    public function destroy(Request $request)
    {
        return $this->payment->destroy($request);
    }
}
