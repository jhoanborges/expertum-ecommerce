<?php
// Aqui nos conectamos anuestra tabla de monedas para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipocuentamodelo extends Model
{
    protected $table = 'tipocuenta';
	protected $fillable = ['nombretipocuenta'];
	public $timestamps = false;
}