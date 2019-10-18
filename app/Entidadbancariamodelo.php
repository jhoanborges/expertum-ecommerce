<?php
// Aqui nos conectamos anuestra tabla de entidades_bancarias para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidadbancariamodelo extends Model
{
    protected $table = 'entidades_bancarias';
	protected $fillable = ['nombre'];
	public $timestamps = false;
}