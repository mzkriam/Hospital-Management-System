<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, Translatable;
    public $translatedAttributes = ["name", "notes"];
    public $fillable = ['name', 'notes', 'Total_with_tax', 'tax_rate', 'Total_after_discount', 'discount_value', 'Total_before_discount'];
    public function service_group()
    {
        return $this->belongsToMany(Service::class, 'service_group')->withPivot("quantity");
    }
}
