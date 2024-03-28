<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabServiceTranslation extends Model
{
    use HasFactory;
    protected $table = 'lab_service_translations';
    public $fillable = ["name", 'description', 'description_employee'];
    public $timestamp = false;
}
