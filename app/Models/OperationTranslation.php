<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OperationTranslation extends Model
{
    use HasFactory;
    protected $table = 'operation_translations';
    public $fillable = ["name", 'description', 'results', 'side_effects', 'warnings', 'procedures'];
    public $timestamp = false;
}
