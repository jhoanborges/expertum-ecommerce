<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagofacturamodelo extends Model
{
    protected $table = 'pago_factura';
	protected $fillable = ['id_factura', 'merchant_id'];
	public $timestamps = false;
}