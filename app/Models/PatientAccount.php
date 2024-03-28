<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientAccount extends Model
{
    use HasFactory;
    protected $fillable = ['credit', 'ray_id', 'lab_id', 'operation_id', 'Debit', 'receipt_id', 'Payment_id', 'invoice_id', 'patient_id', 'date'];
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function RayService()
    {
        return $this->belongsTo(RayService::class, 'ray_id');
    }
    public function LabService()
    {
        return $this->belongsTo(LabService::class, 'lab_id');
    }
    public function operation()
    {
        return $this->belongsTo(Operation::class, 'operation_id');
    }
    public function ReceiptAccount()
    {
        return $this->belongsTo(ReceiptAccount::class, 'receipt_id');
    }
    public function PaymentAccount()
    {
        return $this->belongsTo(PaymentAccount::class, 'Payment_id');
    }
}
