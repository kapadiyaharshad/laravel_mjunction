<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayerCode extends Model
{
    use HasFactory;
    protected $table = 'payer_codes';
    protected $fillable = [
        'client_id',
        'payer_code',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public $timestamps = false;
}
