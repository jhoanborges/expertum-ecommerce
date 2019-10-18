<?php
//Aqui nos conectamos anuestra tabla de paises para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Medidamodelo extends Model
{
    protected $table = 'unidadmedida';
	protected $fillable = ['id', 'descripcion'];
	public $timestamps = false;
}