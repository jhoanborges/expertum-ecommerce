<?php

namespace App;
use DB as DB;

use Illuminate\Database\Eloquent\Model;

class Categoria6 extends Model
{
    	protected $table = 'categoria_n6';
        protected $fillable = [];
		protected $guarded = ['id'];
     	public $timestamps = false;

   public function categories($val)
    {


   // return $this->belongsToMany('App\Categoria7' , 'categoria6_categoria7', 'categoria6_id' , 'categoria7_id' )->whereHas('product');


return $this->belongsToMany('App\Categoria7' , 'categoria6_categoria7', 'categoria6_id' , 'categoria7_id' ) 
->whereHas('product',function ($query) use ($val) {
    $query->whereIn('product_id', $val);
})->get();


/*
 $aja=   Categoria7::
   // join('categoria6_categoria7', 'categoria6_categoria7.categoria6_id', 'categoria_n7.id')
    join('product_categoria7s', 'product_categoria7s.categoria7_id', 'categoria_n7.id')
    ->whereHas('product',function ($query) use ($val) {
    $query->where('product_id', '=', $val);
})->get();

return $aja;
*/

    }


/*

       public function categoria()
    {
        return $this->belongsToMany('App\Categorian1modelo' , 'categoria1_categoria6s', 'categoria1_id' , 'categoria6_id' );
    }
*/



       public function productos()
    {
        return $this->belongsToMany('App\Productomodelo' , 'product_categoria7s', 'categoria7_id' , 'product_id' );
    }

/*
        public function product()
    {
        return $this->belongsToMany('App\Productomodelo', 'product_categoria6s',  'categoria6_id'  ,'product_id' );
    }
*/

        public function product()
    {
        return $this->belongsToMany('App\Productomodelo', 'product_categoria6s',  'categoria6_id'  ,'product_id' );
    }






}
