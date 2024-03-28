<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Doctor;
use App\Models\Section;

class Appointment extends Model
{
    use HasFactory, Translatable;
    public $fillable = ['admin_id', 'reception_id', 'name', 'notes', 'Address', 'method', 'email', 'gender', 'birth_patient', 'Blood_Group', 'phone', 'patient_id', 'doctor_id', 'section_id', 'insurance_id', 'type', 'appointment'];
    public $translatedAttributes = ['name', 'notes', 'Address'];
    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
}
