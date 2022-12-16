<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Factura_Ventas extends Model
{
	protected $table = 'factura_ventas';
	protected $guarded = ['id'];
	protected $fillable = [];
}
