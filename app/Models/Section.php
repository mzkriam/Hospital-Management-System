<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory, Translatable;
    protected $fillable = ["name", "description", 'head_of_department', 'location', 'contact_number'];
    public $translatedAttributes = ['name', 'description', 'head_of_department', 'location'];
    public function doctors()
    {
        return $this->hasMany(Doctor::class);
    }
    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
    public function operations()
    {
        return $this->hasMany(Operation::class);
    }
}
