<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingTranslation extends Model
{
    use HasFactory;
    protected $table = 'accounting_translations';
    public $fillable = ['name', 'job_title', 'description'];
    public $timestamp = false;
}
