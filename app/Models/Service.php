<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;

class Service extends Model
{
    use HasFactory, Translatable;
    protected $fillable = ['section_id', "name", 'price', 'status', 'description'];
    protected $translatedAttributes = ["name", 'description'];
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
