<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'designations';
    protected $fillable = [
        'id',
        'name',
        'description',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public $timestamps = false;
}
