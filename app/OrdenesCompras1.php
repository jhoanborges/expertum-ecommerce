<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenesCompras1 extends Model
{
  	protected $table = 'orden_compras1';
	protected $guarded = ['id_ocompra'];
	protected $primaryKey = 'id_ocompra';
	protected $fillable = [];
}
