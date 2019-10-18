<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Trasportadormodelo extends Model
{
    protected $table = 'trasportadores';
	protected $fillable = ['nombretrasportador','numerodocumento','direccion','telefonocontacto','correoelectronico','estado'];
	public $timestamps = false;
}