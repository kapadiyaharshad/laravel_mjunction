<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessUnit extends Model
{
    use HasFactory;
    protected $table = 'business_units';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'bu_name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
