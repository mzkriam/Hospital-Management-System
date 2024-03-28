<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;
use App\Models\Invoice;

class ReceiptAccount extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'patient_id', 'amount', 'description', 'invoice_id', 'accountings_id', 'admin_id'];
    public function patients()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }
}
