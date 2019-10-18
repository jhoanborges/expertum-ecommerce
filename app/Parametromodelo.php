<?php
//Aqui nos conectamos anuestra tabla de parametros para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Parametromodelo extends Model
{
    protected $table = 'parametros';
	protected $fillable = ['nombre_tienda', 'direccion','numerocontacto','correo','cantidad_critica'];
	public $timestamps = false;
}