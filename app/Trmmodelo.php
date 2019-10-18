<?php
// Aqui nos conectamos anuestra tabla de monedas para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Trmmodelo extends Model
{
    protected $table = 'trm';
	protected $fillable = ['fecha','valor_trm'];
	public $timestamps = false;
}