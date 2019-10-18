<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ciudades extends Model
{
        protected $table = 'city';
	protected $fillable = [];
	protected $guarded = 'id';
	public $timestamps = false;
}
