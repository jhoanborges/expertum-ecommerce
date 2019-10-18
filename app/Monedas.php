<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Monedas extends Model
{
    	protected $table = 'monedas';
        protected $fillable = [
        'id', 'name', 'code' , 'symbol',
    ];

    	public $timestamps = false;
}
