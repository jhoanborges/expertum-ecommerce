<?php
// Aqui nos conectamos anuestra tabla de monedas para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Monedamodelo extends Model
{
    protected $table = 'monedas';
	protected $fillable = ['nombre_moneda','monedalocal'];
	public $timestamps = false;
}