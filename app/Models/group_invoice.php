<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_invoice extends Model
{
    use HasFactory;
    protected $fillable = ['invoice_date', 'patient_id', 'doctor_id', 'section_id', 'Group_id', 'price', 'discount_value', 'tax_rate', 'tax_value', 'total_with_tax', 'type'];
    public function Group()
    {
        return $this->belongsTo(Group::class, 'Group_id');
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function Doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
}
