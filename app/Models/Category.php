<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'id',
        'category_name',
        'created_at',
        'created_by',
        'updated_at',
        'updated_by'
    ];
    public $timestamps = false;
}
