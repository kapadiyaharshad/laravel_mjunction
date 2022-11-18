<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $fillable = [
        'client_name',
        'client_code',
        'email',
        'contact',
        'mobile',
        'account_type_id',
        'profit_center_id',
        'business_unit_id',
        'category_id',
        'business_segment_id',
        'service_id',
        'user_id',
        'status',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by',
    ];
}
