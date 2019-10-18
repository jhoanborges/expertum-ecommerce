<?php
//Aqui nos conectamos anuestra tabla de departamentos para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamentomodelo extends Model
{
    protected $table = 'departamentos';
	protected $fillable = ['id_pais', 'nombre_departamento', 'codigo_departamento'];
	public $timestamps = false;
}