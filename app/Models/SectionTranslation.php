<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'head_of_department', 'location'];
    public $timestamp = false;
}
