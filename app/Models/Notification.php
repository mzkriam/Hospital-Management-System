<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    public $fillable = ['message', 'user_id', 'patient_id', 'invoice_id', 'ray_service_id', 'lab_service_id', 'treatment_id', 'operation_id', 'reader_status'];
    public function Patient()
    {
        return $this->belongsTo(Patient::class, 'patient_id');
    }
    public function scopeCountNotification($query, $user_id)
    {
        $query->where('user_id', $user_id)->where('reader_status', 0);
    }
}
