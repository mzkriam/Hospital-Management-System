<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LabEmployeeTranslation extends Model
{
    use HasFactory;
    public $fillable = ['name', 'job_title', 'description'];
    public $timestamp = false;
}
