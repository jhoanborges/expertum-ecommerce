<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenCompra extends Model
{
	protected $table = 'orden_compras';
	protected $guarded = ['id'];
	protected $fillable = [];


        	public function productosCantidad()
	{
		return $this->hasMany('App\Product' ,'id' ,'id_producto');
	}

        	public function proveedor()
	{
		return $this->hasMany('App\Proveedores' ,'id' ,'id_proveedor');
	}




}
