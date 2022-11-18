<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitCenter extends Model
{
    use HasFactory;
    protected $table = 'profit_centers';
    protected $fillable = [
        'business_unit_id',
        'profit_center',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public $timestamps = false;
}
