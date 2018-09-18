<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //nombre de la tabla en la BD a la que este modelo hace referencia
	protected $table = 'categoria';
	//los campos que se pueden completar por el cliente
	protected $fillable = ['tipo'];
	//eliminamos los campos UPDATED AT y  CREATED AT que laravel crea y editar
	//automaticamente para nosotros
	public $timestamps = false;
}
