<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use App\Parametromodelo;

class Marcas extends Model
{
	protected $table = 'marcas';
	protected $guarded = ['id'];
	protected $fillable = [];
	public $timestamps = false;


	public function categories()
	{
		return $this->belongsToMany('App\Categorian1modelo' , 'marcas_categorias', 'marcas_id' , 'category_id' );
	}





	public function belongsToManyProducts()
	{
		return $this->belongsToMany('App\Productomodelo' , 'product_marcas', 'marca_id' , 'product_id' );
	}




        public function product_total($ids)
    {


    	//aca se revisa si en parametros esta habilitada la opcion mostrar en tienda los que no tienen inventario (cantidad)
    	$parametros=Parametromodelo::first();

    	if ($parametros->store_show ==true) {

return $this
        ->belongsToMany('App\Productomodelo', 'product_marcas',  'marca_id'  ,'product_id' )
        ->where( function ($query) use ($ids) {
    $query
    ->has('hasOneCategoria1')
    ->where('estado', true);
   // ->whereIn('product_id', $ids);
})
        ->count();

    	}else{

return $this->belongsToMany('App\Productomodelo', 'product_marcas',  'marca_id'  ,'product_id' )
        ->where(function ($query) use ($ids) {
    $query
   ->has('hasOneCategoria1')
   // ->whereIn('product_id', $ids)
     ->where('productos.cantidad', '>', 0);
})->count();

    }


}




}
