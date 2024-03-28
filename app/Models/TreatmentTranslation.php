<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentTranslation extends Model
{
    use HasFactory;
    protected $table = 'treatment_translations';
    public $fillable = ["name", 'description', 'results', 'side_effects', 'warnings', 'procedures'];
    public $timestamp = false;
}
