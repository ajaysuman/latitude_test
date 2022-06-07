<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;


class category extends Model
{
    use HasFactory, softDeletes;
    protected $table = 'category';
    protected $fillable = [
        'name','logo'
    ];
    
     public function subcategories(){
        return $this->hasMany('App\Category', 'id');
    } 

    protected $dates = ['deleted_at'];
}
