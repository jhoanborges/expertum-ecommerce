<?php
// Aqui nos conectamos anuestra tabla de formaspago para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Facturamodelo extends Model
{
    protected $table = 'factura';
	protected $fillable = [];
	protected $guarded = ['id'];
	//public $timestamps = false;
}