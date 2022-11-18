<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Freeze extends Model
{
    use HasFactory;
    protected $table = 'freezes';
    protected $fillable = [
        'month',
        'freeze_type',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public $timestamps = false;
}
