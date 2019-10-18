<?php
//Aqui nos conectamos anuestra tabla de paises para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Marcamodelo extends Model
{
    protected $table = 'marcas';
	protected $fillable = ['id', 'nombre'];
	public $timestamps = false;
}