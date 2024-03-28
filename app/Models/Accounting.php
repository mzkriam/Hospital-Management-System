<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Webpatser\Uuid\Uuid;
use App\Models\Image;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Accounting extends Authenticatable
{
    use HasFactory, Translatable;
    protected $table = 'accountings';
    public $translatedAttributes = ['name', 'job_title', 'description'];
    public $fillable = ['email', 'email_verified_at', 'password', 'phone', 'job_number', 'name', 'job_title', 'description', 'status'];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
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
