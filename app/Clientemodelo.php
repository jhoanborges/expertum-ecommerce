<?php
//Aqui nos conectamos anuestra tabla de clientes para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientemodelo extends Model
{
	protected $table = 'clientes';
	protected $fillable = ['nombre_cliente', 'apellidos_cliente', 'telefono_cliente', 'nombre_contacto','telefono_contacto','genero','tipopersona','id_tipoidentificacion','numero_identificacion','correoelectronico','fechanacimiento','id_pais','id_departamento','id_ciudad','barrio','direcciondomicilio','direccionentrega','contraseña','boletin','habeasdata','terminosycondiciones','fecharegistro','fechaultimacompra','actualizado','estado'];
	public $timestamps = false;
}