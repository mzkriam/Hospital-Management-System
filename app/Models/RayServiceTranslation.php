<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RayServiceTranslation extends Model
{
    use HasFactory;
    public $fillable = ["name", 'description', 'description_employee'];
    public $timestamp = false;
}
