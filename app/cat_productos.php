<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_productos extends Model
{

    protected $table = 'cat_productos';

    protected $fillable = ['nombre', 'usa_stock'];
    
    
    public $timestamps = false;
}
