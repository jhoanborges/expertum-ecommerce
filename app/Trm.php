<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trm extends Model
{
    protected $table = 'trm';
    protected $guarded = ['id'];
    protected $fillable = [];
	//protected $fillable = ['fecha','valor_trm'];
	public $timestamps = false;
}
