<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use EloquentFilter\Filterable;
use DB as DB;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Categoria7 extends Model
{
    use Filterable;
    use Searchable;

        	protected $table = 'categoria_n7';
        protected $fillable = [];
		protected $guarded = ['id'];
     	public $timestamps = false;
        public $idd=0;



/**
 * Get the indexable data array for the model.
 *
 * @return array<string, mixed>
 */
#[SearchUsingPrefix(['id', 'email'])]
#[SearchUsingFullText(['bio'])]
public function toSearchableArray(): array
{
    return [
        'id' => $this->id,
        'nombrecategoria' => $this->nombrecategoria,
    ];
}
     	   public function categories()
    {
        return $this->belongsToMany('App\Categoria6' , 'categoria6_categoria7', 'categoria7_id' , 'categoria6_id' );
    }


        public function product()
    {
        $query = $this->belongsToMany('App\Productomodelo', 'product_categoria7s',  'categoria7_id'  ,'product_id' );
               //->where('product_id', '408');
return $query;


/*
            $proj = Categoria6::whereHas('product', function($q) use ($id){
                $q->where('productos.id', $id);
        })->get();
            dd($proj);
return $proj;
  */

    }


        public function product_total($ids)
    {
        return $this->

        belongsToMany('App\Productomodelo', 'product_categoria7s',  'categoria7_id'  ,'product_id' )
        ->where(function ($query) use ($ids) {
    $query
    ->where('estado', true)
    //where('productos.estado', true)->
    ->whereIn('product_id', $ids);
})->get();
    }






}
