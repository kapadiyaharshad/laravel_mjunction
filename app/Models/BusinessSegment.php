<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessSegment extends Model
{
    use HasFactory;
    protected $table = 'business_segments';
    public $timestamps = false;
    protected $fillable = [
        'name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
