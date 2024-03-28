<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class phaEmployeeTranslation extends Model
{
    use HasFactory;
    protected $table = "pha_employee_translations";

    public $fillable = ['name', 'job_title', 'description'];
    public $timestamp = false;
}
