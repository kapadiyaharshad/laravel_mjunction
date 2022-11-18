<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    protected $table = 'revenues';
    protected $fillable = [
        'month',
        'abp_id',
        'actual',
        'original_estimate',
        'original_estimate_vaor',
        'revised_estimate',
        'revised_estimate_vaor',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public $timestamps = false;
}
