<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use Translatable;
    use HasFactory;
    public $translatedAttributes = ['name', 'Address'];
    public $fillable = ['status', 'name', 'Address', 'email', 'password', 'Date_Birth', 'Phone', 'Gender', 'Blood_Group'];
    public function insurance()
    {
        return $this->belongsTo(Insurance::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function Medicines()
    {
        return $this->belongsToMany(Medicine::class, 'patients_medicines', 'patient_id', 'medicine_id');
    }
}
