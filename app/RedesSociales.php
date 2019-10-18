<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RedesSociales extends Model
{
        protected $table = 'redes_sociales';
        protected $fillable = [];
		protected $guarded = ['id'];
     	//public $timestamps = false;


             	public function RedesSociales()
{
    return $this->belongsTo('App\Parametros')->withDefault();
}

}
