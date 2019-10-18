<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudadmodelo extends Model
{
    protected $table = 'ciudades';
	protected $fillable = ['id_pais', 'id_departamento', 'nombre_ciudad', 'codigo_ciudad'];
	public $timestamps = false;
}