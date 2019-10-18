<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Provedormodelo extends Model
{
    protected $table = 'provedores';
	protected $fillable = ['nombreprovedor','id_tipoidentificacion','numerodocumento','nombrecontacto','telefono','telefonocontacto','direccion','correoelectronico','id_formapago','tiempopago','manejactabancaria','id_entidadbancaria1','id_tipocuenta1','numerocuenta1','titular1','id_entidadbancaria2','id_tipocuenta2','numerocuenta2','titular2','manejaws','id_pais',
 		'id_departamento','id_ciudad','estado'];
	public $timestamps = false;
}