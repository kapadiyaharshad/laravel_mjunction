<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Abp extends Model
{
    use HasFactory;
    protected $table = 'abps';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'month',
        'profit_center_id',
        'payer_code_id',
        'target_amount',
        'target_amount_vaor',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
