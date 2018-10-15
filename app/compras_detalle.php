<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compras_detalle extends Model
{
    protected $table = 'compras_detalle';
    
    protected $fillable = ['compra_id', 'producto_id', 'costo_unitario', 'cantidad', 'sub_total'];
    
    
    public $timestamps = false;
}
