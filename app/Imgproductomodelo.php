<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Imgproductomodelo extends Model
{
    protected $table = 'imgproductos';
    protected $guarded= ['id'];
	//protected $fillable = ['id_provedor', 'referencia', 'id_producto', 'urlimagen', 'estado'];
	protected $fillable = [];
	public $timestamps = false;
}