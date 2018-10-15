<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cat_personas extends Model
{
    protected $table = 'cat_personas';
    
    protected $fillable = ['per_id', 'cat_id'];
    
    
    public $timestamps = false;
}
