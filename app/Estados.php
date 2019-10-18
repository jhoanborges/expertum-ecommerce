<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{
        protected $table = 'region';
	protected $fillable = [];
	protected $guarded = ['id'];
	public $timestamps = false;
}
