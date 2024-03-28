<?php

namespace App\Http\Livewire;

use App\Events\CreateInvoice;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\FundAccount;
use App\Models\Invoice;
use App\Models\Patient;
use App\Models\PatientAccount;
use App\Models\Service;
use App\Models\Notification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class SingleInvoices extends Component
{
    public $catchError, $InvoiceSaved, $InvoiceUpdated;
    public $show_table = true;

    public $price, $discount_value = 0, $patient_id, $doctor_id, $section_id, $type, $Service_id, $single_invoice_id;
    public $updateMode = false;
    public $tax_rate = 17;
    public $username;
    public function mount()
    {
        $this->username = auth()->user()->name;
    }

    public function render()
    {
        return view('livewire.single_invoices.single-invoices', [
            'single_invoices' => Invoice::where('invoice_type', 1)->get(),
            'Patients' => Patient::all(),
            'Doctors' => Doctor::all(),
            'Services' => Service::all(),
            'subtotal' => $Total_after_discount = ((is_numeric($this->price) ? $this->price : 0)) - ((is_numeric($this->discount_value) ? $this->discount_value : 0)),
            'tax_value' => $Total_after_discount * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100)
        ]);
    }
    public function show_form_add()
    {
        $this->show_table = false;
    }
    public function show_table()
    {
        $this->show_table = true;
    }
    public function print($id)
    {
        $single_invoice = Invoice::findOrFail($id);
        if (auth('admin')->check()) {
            return Redirect::route('admin_Print_single_invoices', [
                'invoice_date' => $single_invoice->invoice_date,
                'doctor_id' => $single_invoice->Doctor->name,
                'patient_id' => $single_invoice->Patient->name,
                'section_id' => $single_invoice->Section->name,
                'Service_id' => $single_invoice->Service->name,
                'type' => $single_invoice->type,
                'price' => $single_invoice->price,
                'discount_value' => $single_invoice->discount_value,
                'tax_rate' => $single_invoice->tax_rate,
                'total_with_tax' => $single_invoice->total_with_tax,
            ]);
        } else {
            return Redirect::route('Print_single_invoices', [
                'invoice_date' => $single_invoice->invoice_date,
                'doctor_id' => $single_invoice->Doctor->name,
                'patient_id' => $single_invoice->Patient->name,
                'section_id' => $single_invoice->Section->name,
                'Service_id' => $single_invoice->Service->name,
                'type' => $single_invoice->type,
                'price' => $single_invoice->price,
                'discount_value' => $single_invoice->discount_value,
                'tax_rate' => $single_invoice->tax_rate,
                'total_with_tax' => $single_invoice->total_with_tax,
            ]);
        }
    }
    // public function get_section()
    // {
    //     $doctor_id = Doctor::with('section')->where('id', $this->doctor_id)->first();
    //     $this->section_id = $doctor_id->section->name;
    // }
    public $service_selected, $section_name, $doctor_name, $section_selected_id, $doctor_selected_id;
    public function get_price()
    {
        $this->service_selected = Service::findOrFail($this->Service_id);
        $this->price = $this->service_selected->price;
        $this->section_name = $this->service_selected->section->name;
        $this->section_selected_id = $this->service_selected->section->id;
        $this->doctor_name = $this->service_selected->doctor->name;
        $this->doctor_selected_id = $this->service_selected->doctor->id;
    }
    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $single_invoice = Invoice::findOrFail($id);
        $this->single_invoice_id = $single_invoice->id;
        $this->patient_id = $single_invoice->patient_id;
        $this->doctor_selected_id = $single_invoice->doctor_id;
        $this->doctor_name = $single_invoice->doctor->name;
        $this->section_selected_id = $single_invoice->section_id;
        $this->section_name = $single_invoice->section->name;
        $this->Service_id = $single_invoice->Service_id;
        $this->price = $single_invoice->price;
        $this->discount_value = $single_invoice->discount_value;
        $this->type = $single_invoice->type;
    }
    public function store()
    {
        //نقدي
        if ($this->type == 1) {
            DB::beginTransaction();
            try {
                //التعديل
                if ($this->updateMode) {
                    $single_invoices = Invoice::findOrFail($this->single_invoice_id);
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_selected_id;
                    $single_invoices->section_id = $this->section_selected_id;
                    $single_invoices->Service_id = $this->Service_id;
                    if (auth('admin')->check()) {
                        $single_invoices->accountings_id = NULL;
                        $single_invoices->admin_id = auth()->user()->id;
                    } else {
                        $single_invoices->admin_id = NULL;
                        $single_invoices->accountings_id = auth()->user()->id;
                    }
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $fund_accounts = FundAccount::where('invoice_id', $this->single_invoice_id)->first();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->Debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $patient = Patient::find($this->patient_id);
                    $appointment_info = Appointment::where('doctor_id', $this->doctor_selected_id)->where('email', $patient->email)->where('type', 'certain')->first();
                    if ($appointment_info) {
                        $appointment = Appointment::find($appointment_info->id);
                        $appointment->update([
                            'type' => 'expired'
                        ]);
                    }

                    $notifications = new Notification();
                    $notifications->patient_id = $single_invoices->patient_id;
                    $notifications->user_id = $this->doctor_selected_id;
                    $notifications->invoice_id = $single_invoices->id;
                    $notifications->message = "new examination : " . $patient->name;
                    $notifications->save();

                    $data = [
                        'patient' => $this->patient_id,
                        'invoice_id' => $single_invoices->id,
                        'doctor_id' => $this->doctor_selected_id,
                    ];
                    event(new CreateInvoice($data));


                    $this->InvoiceUpdated = true;
                    $this->show_table = true;
                }
                //الاضافة
                else {
                    $single_invoices = new Invoice();
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_selected_id;
                    if (auth('admin')->check()) {
                        $single_invoices->accountings_id = NULL;
                        $single_invoices->admin_id = auth()->user()->id;
                    } else {
                        $single_invoices->admin_id = NULL;
                        $single_invoices->accountings_id = auth()->user()->id;
                    }
                    $single_invoices->section_id = $this->section_selected_id;
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    $fund_accounts = new FundAccount();
                    $fund_accounts->date = date('Y-m-d');
                    $fund_accounts->invoice_id = $single_invoices->id;
                    $fund_accounts->Debit = $single_invoices->total_with_tax;
                    $fund_accounts->credit = 0.00;
                    $fund_accounts->save();

                    $this->InvoiceSaved = true;
                    $this->show_table = true;

                    $patient = Patient::find($this->patient_id);
                    $appointment_info = Appointment::where('doctor_id', $this->doctor_selected_id)->where('email', $patient->email)->where('type', 'certain')->first();
                    if ($appointment_info) {
                        $appointment = Appointment::find($appointment_info->id);
                        $appointment->update([
                            'type' => 'expired'
                        ]);
                    }

                    $notifications = new Notification();
                    $notifications->patient_id = $single_invoices->patient_id;
                    $notifications->user_id = $this->doctor_selected_id;
                    $notifications->invoice_id = $single_invoices->id;
                    $notifications->message = "new examination : " . $patient->name;
                    $notifications->save();

                    // $data = [
                    //     'patient' => $this->patient_id,
                    //     'invoice_id' => $single_invoices->id,
                    //     'doctor_id' => $this->doctor_selected_id,
                    // ];
                    // event(new CreateInvoice($data));
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->catchError = $e->getMessage();
            }
        }
        //اجل
        else {
            DB::beginTransaction();
            try {
                //   التعديل
                if ($this->updateMode) {
                    $single_invoices = Invoice::findOrFail($this->single_invoice_id);
                    $single_invoices->invoice_type = 1; //single
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_selected_id;
                    $single_invoices->section_id = $this->section_selected_id;
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    if (auth('admin')->check()) {
                        $single_invoices->accountings_id = NULL;
                        $single_invoices->admin_id = auth()->user()->id;
                    } else {
                        $single_invoices->admin_id = NULL;
                        $single_invoices->accountings_id = auth()->user()->id;
                    }
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->save();

                    $patient_accounts = PatientAccount::where('invoice_id', $this->single_invoice_id)->first();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->Debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();

                    $patient = Patient::find($this->patient_id);
                    $appointment_info = Appointment::where('doctor_id', $this->doctor_selected_id)->where('email', $patient->email)->where('type', 'certain')->first();
                    if ($appointment_info) {
                        $appointment = Appointment::find($appointment_info->id);
                        $appointment->update([
                            'type' => 'expired'
                        ]);
                    }

                    $notifications = new Notification();
                    $notifications->patient_id = $single_invoices->patient_id;
                    $notifications->user_id = $this->doctor_selected_id;
                    $notifications->invoice_id = $single_invoices->id;
                    $notifications->message = "new examination : " . $patient->name;
                    $notifications->save();

                    $data = [
                        'patient' => $this->patient_id,
                        'invoice_id' => $single_invoices->id,
                        'doctor_id' => $this->doctor_selected_id,
                    ];
                    event(new CreateInvoice($data));

                    $this->InvoiceUpdated = true;
                    $this->show_table = true;
                }
                //   الاضافة
                else {
                    $single_invoices = new Invoice();
                    $single_invoices->accountings_id = auth()->user()->id;
                    $single_invoices->invoice_type = 1;
                    $single_invoices->invoice_date = date('Y-m-d');
                    $single_invoices->patient_id = $this->patient_id;
                    $single_invoices->doctor_id = $this->doctor_selected_id;
                    $single_invoices->section_id = $this->section_selected_id;
                    if (auth('admin')->check()) {
                        $single_invoices->accountings_id = NULL;
                        $single_invoices->admin_id = auth()->user()->id;
                    } else {
                        $single_invoices->admin_id = NULL;
                        $single_invoices->accountings_id = auth()->user()->id;
                    }
                    $single_invoices->Service_id = $this->Service_id;
                    $single_invoices->price = $this->price;
                    $single_invoices->discount_value = $this->discount_value;
                    $single_invoices->tax_rate = $this->tax_rate;
                    $single_invoices->tax_value = ($this->price - $this->discount_value) * ((is_numeric($this->tax_rate) ? $this->tax_rate : 0) / 100);
                    $single_invoices->total_with_tax = $single_invoices->price -  $single_invoices->discount_value + $single_invoices->tax_value;
                    $single_invoices->type = $this->type;
                    $single_invoices->invoice_status = 1;
                    $single_invoices->save();

                    $patient_accounts = new PatientAccount();
                    $patient_accounts->date = date('Y-m-d');
                    $patient_accounts->invoice_id = $single_invoices->id;
                    $patient_accounts->patient_id = $single_invoices->patient_id;
                    $patient_accounts->Debit = $single_invoices->total_with_tax;
                    $patient_accounts->credit = 0.00;
                    $patient_accounts->save();

                    $patient = Patient::find($this->patient_id);
                    $appointment_info = Appointment::where('doctor_id', $this->doctor_selected_id)->where('email', $patient->email)->where('type', 'certain')->first();
                    if ($appointment_info) {
                        $appointment = Appointment::find($appointment_info->id);
                        $appointment->update([
                            'type' => 'expired'
                        ]);
                    }

                    $notifications = new Notification();
                    $notifications->patient_id = $single_invoices->patient_id;
                    $notifications->user_id = $this->doctor_selected_id;
                    $notifications->invoice_id = $single_invoices->id;
                    $notifications->invoice_id = $single_invoices->id;
                    $notifications->message = "new examination : " . $patient->name;
                    $notifications->save();

                    $data = [
                        'patient' => $this->patient_id,
                        'invoice_id' => $single_invoices->id,
                        'doctor_id' => $this->doctor_selected_id,
                    ];
                    event(new CreateInvoice($data));

                    $this->InvoiceSaved = true;
                    $this->show_table = true;
                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                $this->catchError = $e->getMessage();
            }
        }
    }
    public function delete($id)
    {
        $this->single_invoice_id = $id;
    }
    public function destroy()
    {
        Invoice::destroy($this->single_invoice_id);
        if (auth('admin')->check()) {
            return redirect()->route('admin_single_invoices');
        } else {
            return redirect()->route('single_invoices');
        }
    }
}
