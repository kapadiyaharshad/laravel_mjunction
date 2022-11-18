<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    use HasFactory;
    protected $table = 'collections';
    protected $fillable = [
        'estimate_type',
        'estimate_type_id',
        'projection',
        'user_id',
        'assumptions',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public $timestamps = false;
}
