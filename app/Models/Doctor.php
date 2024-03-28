<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Image;
use App\Models\Section;
use Webpatser\Uuid\Uuid;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Doctor extends Authenticatable
{
    use HasFactory, Translatable;
    public $translatedAttributes = ["name"];
    public $fillable = ['email', 'email_verified_at', 'password', 'phone', 'job_number', 'name', 'section_id', 'status', 'number_of_statements'];
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->job_number = (string) Uuid::generate();
        });
    }
}
