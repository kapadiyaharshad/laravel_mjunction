<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SapDumpLog extends Model
{
    use HasFactory;
    protected $table = 'revenues';
    protected $fillable = [
        'assignment',
        'document_number',
        'document_type',
        'posting_key',
        'amount',
        'reference',
        'cost_center',
        'profit_center',
        'sp_g_l_trans_type',
        'g_l_account',
        'posting_date',
        'purchasing_document',
        'material',
        'sales_document',
        'clearing_document',
        'customer',
        'dump_type',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];

    public $timestamps = false;
}
