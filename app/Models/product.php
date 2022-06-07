<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class product extends Model
{
    use HasFactory , softDeletes;
    
    protected $table = 'product';
    protected $fillable = [
        'name','logo'
    ];
    
    protected $dates = ['deleted_at'];
}
