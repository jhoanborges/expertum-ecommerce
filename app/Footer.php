<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
            protected $table = 'footers';
        protected $fillable = [];
      protected $guarded = ['id'];

      	public function items()
	{
		return $this->hasMany('App\Subtitulos' , 'id_titulo' );
	}


}
