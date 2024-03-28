<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;


class Ambulance extends Model
{
    use HasFactory, Translatable;
    protected $fillable = ["car_number", "car_year_made", "car_model", "driver_license_number", 'driver_phone', 'is_available', 'car_type'];
    protected $translatedAttributes = ["driver_name", "notes"];
}
