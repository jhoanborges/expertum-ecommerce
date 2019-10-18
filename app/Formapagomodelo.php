<?php
// Aqui nos conectamos anuestra tabla de formaspago para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;

class Formapagomodelo extends Model
{
    protected $table = 'formaspago';
	protected $fillable = ['nombre'];
	public $timestamps = false;
}