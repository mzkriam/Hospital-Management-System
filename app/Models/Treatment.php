<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use App\Models\Doctor;
use App\Models\Medicine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory, Translatable;
    protected $table = 'treatments';
    public $fillable = [
        "doctor_id", "patient_id", "invoice_id", "review_date", "date", "name", 'description', 'results',
        'side_effects', 'warnings', 'procedures'
    ];
    public $translatedAttributes = ["name", 'description', 'results', 'side_effects', 'warnings', 'procedures'];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function Medicines()
    {
        return $this->belongsToMany(Medicine::class, 'treatment_medicines', 'treatment_id', 'treatment_medicines_id');
    }
}
