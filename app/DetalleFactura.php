<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetalleFactura extends Model
{
                	 protected $table = 'detallefactura';
        	protected $guarded = ['id'];
 		protected $fillable = [];
 		     public $timestamps = false;

        	public function productosCantidad()
	{
		return $this->hasMany('App\Product' ,'id' ,'id_producto');
	}
}
