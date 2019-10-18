<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura_Ventas extends Model
{
	protected $table = 'detallefactura_ventas';
	protected $guarded = ['id'];
	protected $fillable = [];
	public $timestamps = false;

	/*
	public function productosCantidad()
	{
		return $this->hasMany('App\Product' ,'id' ,'id_producto');
	}
	*/
}
