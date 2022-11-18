<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    use HasFactory;
    protected $table = 'audit_trails';
    public $timestamps = false;
    protected $fillable = [
        'entity_id',
        'entity_name',
        'previous_entry',
        'present_entry',
        'created_at',
        'created_by',
    ];
}
