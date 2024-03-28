<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use App\Models\PhaEmployee;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory, Translatable;
    protected $table = 'medicines';
    public $fillable = ["name", 'description', 'code', 'price', 'pha_employee_id', 'status'];
    public $translatedAttributes = ["name", 'description'];
    public function PhaEmployee()
    {
        return $this->belongsTo(PhaEmployee::class, 'pha_employee_id');
    }
}
