<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Imagenpromomodelo extends Model
{
    protected $table = 'imgpromociones';
	protected $fillable = ['id_provedor', 'referencia', 'id_producto', 'urlimagen','estado'];
	public $timestamps = false;
}