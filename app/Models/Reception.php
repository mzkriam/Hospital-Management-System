<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Webpatser\Uuid\Uuid;
use Astrotomic\Translatable\Translatable;


class Reception extends Authenticatable
{
    use HasFactory, Translatable;
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
