<?php

namespace App\Repository\doctor_dashboard;

use App\Interfaces\doctor_dashboard\InvoicesRepositoryInterface;
use App\Models\Invoice;
use App\Models\LabService;
use App\Models\RayService;
use Illuminate\Support\Facades\Auth;

class InvoicesRepository implements InvoicesRepositoryInterface
{
    public function index()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 1)->orderBy('created_at', 'desc')->get();
        return view('Dashboard\doctor\invoices\index', compact('invoices'));
    }
    public function reviewInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 2)->orderBy('created_at', 'desc')->get();
        return view('Dashboard.Doctor.invoices.review_invoices', compact('invoices'));
    }
    public function completedInvoices()
    {
        $invoices = Invoice::where('doctor_id', Auth::user()->id)->where('invoice_status', 3)->orderBy('created_at', 'desc')->get();
        return view('Dashboard.Doctor.invoices.completed_invoices', compact('invoices'));
    }
    public function show($id)
    {
        $rays = RayService::findOrFail($id);
        // if ($rays->doctor_id != auth()->user()->id) {
        //     //abort(404)
        //     return redirect()->route('404');
        // }
        return view('Dashboard.Doctor.invoices.view_rays', compact('rays'));
    }
    public function showPatientLaboratory($id)
    {
        $laboratories  = LabService::findOrFail($id);
        // if ($laboratories->doctor_id != auth()->user()->id) {
        //     return redirect()->route('404');
        // }
        return view('Dashboard.Doctor.invoices.view_laboratories', compact('laboratories'));
    }
}
