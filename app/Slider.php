<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
        protected $table = 'sliders';
        protected $guarded = ['id'];
 		protected $fillable = [];

	public function categoria1()
	{
		return $this->belongsToMany('App\Categorian1modelo' , 'sliders_categoria1s', 'slider_id' , 'category_id' );
	}

	public function categoria2()
	{
		return $this->belongsToMany('App\Categorian2modelo' , 'sliders_categoria2s', 'slider_id' , 'category_id' );
	}
		public function categoria3()
	{
		return $this->belongsToMany('App\Categorian3modelo' , 'sliders_categoria3s', 'slider_id' , 'category_id' );
	}
		public function categoria4()
	{
		return $this->belongsToMany('App\Categorian4modelo' , 'sliders_categoria4s', 'slider_id' , 'category_id' );
	}
		public function categoria5()
	{
		return $this->belongsToMany('App\Categorian5modelo' , 'sliders_categoria5s', 'slider_id' , 'category_id' );
	}
}
