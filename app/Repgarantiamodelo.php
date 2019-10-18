<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Repgarantiamodelo extends Model
{
    protected $table = 'repgarantia';
	protected $fillable = ['nombre','telefono','correoelectronico','direccion'];
	public $timestamps = false;
}