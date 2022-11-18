<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAccoutType extends Model
{
    use HasFactory;
    protected $table = 'user_accout_types';
    protected $fillable = [
        'user_id',
        'account_type_id',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public $timestamps = false;
}
