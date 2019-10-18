<?php
//Aqui nos conectamos anuestra tabla de cuentasprovedor para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuentabancariamodelo extends Model
{
    protected $table = 'cuentasprovedor';
	protected $fillable = ['id_provedor', 'id_tipocuenta', 'id_entidadbancaria', 'numerocuenta', 'titular'];
	public $timestamps = false;
}