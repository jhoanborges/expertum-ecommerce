<?php
//Aqui nos conectamos anuestra tabla de paises para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Paismodelo extends Model
{
    protected $table = 'country';
//	protected $fillable = ['nombre_pais', 'codigo_pais'];
    protected $fillable = [];
	public $timestamps = false;
}