<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    public $fillable = ['doctor_id', 'lab_employee_id', 'ray_employee_id', 'pha_employee_id', 'res_employee_id', 'accounting_id', 'day', 'start_time', 'end_time'];
    public function doctors()
    {
        return $this->belongsTo(Doctor::class);
    }
    public function labEmployees()
    {
        return $this->belongsTo(LabEmployee::class);
    }
    public function rayEmployees()
    {
        return $this->belongsTo(RayEmployee::class);
    }
    public function phaEmployees()
    {
        return $this->belongsTo(phaEmployee::class);
    }
    public function receptionEmployees()
    {
        return $this->belongsTo(Reception::class);
    }
    public function AccountingEmployee()
    {
        return $this->belongsTo(Accounting::class);
    }
}
