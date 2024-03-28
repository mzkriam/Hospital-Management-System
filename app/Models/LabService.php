<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\LabEmployee;

class LabService extends Model
{
    use HasFactory, Translatable;
    protected $table = "lab_services";
    public $fillable = ['invoice_id', 'patient_id', 'doctor_id', 'price', 'lab_employ_id', 'code', 'name', 'description', 'description_employee', 'status', 'case'];
    public $translatedAttributes = ["name", 'description', 'description_employee'];
    public function LabEmployee()
    {
        return $this->belongsTo(LabEmployee::class, 'lab_employ_id');
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    public function employee()
    {
        return $this->belongsTo(LabEmployee::class, 'lab_employ_id')
            ->withDefault(['name' => 'No Employee']);
    }
    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
