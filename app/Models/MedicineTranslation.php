<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicineTranslation extends Model
{
    use HasFactory;
    protected $table = 'medicine_translations';
    public $fillable = ['name', 'description'];
    public $timestamp = false;
}
