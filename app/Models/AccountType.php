<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    use HasFactory;
    protected $table = 'account_types';
    public $timestamps = false;
    protected $fillable = [
        'id',
        'name',
        'code',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
}
