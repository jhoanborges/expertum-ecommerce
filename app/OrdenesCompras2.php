<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdenesCompras2 extends Model
{
  	protected $table = 'orden_compras2';
	protected $guarded = ['id'];
	protected $fillable = []; 
	public $timestamps = false;    
}
