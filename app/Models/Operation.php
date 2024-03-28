<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    use HasFactory, Translatable;
    protected $table = 'operations';

    public $fillable = ["section_id", "patient_id", 'doctor_id', 'invoice_id', 'price', "appointment", "name", 'description', 'results', 'side_effects', 'warnings', 'procedures'];

    public $translatedAttributes = ["name", 'description', 'results', 'side_effects', 'warnings', 'procedures'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function Doctors()
    {
        return $this->belongsToMany(Doctor::class, 'operation_doctors', 'operation_id', 'operation_doctors_id');
    }
    public function Medicines()
    {
        return $this->belongsToMany(Medicine::class, 'operation_medicines', 'operation_id', 'operation_medicines_id');
    }
}
