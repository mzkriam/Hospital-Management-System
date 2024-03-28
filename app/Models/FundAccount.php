<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FundAccount extends Model
{
    use HasFactory;
    protected $fillable = ['credit', 'Debit', 'Payment_id', 'receipt_id', 'date', 'invoice_id'];
}
