<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Promociones extends Model
{


 use Sluggable;


        	 protected $table = 'promociones';
        	protected $guarded = ['id'];
 		protected $fillable = [];

       

    public function sluggable()
    {
        return [
            'imagen' => [
                //'source' => 'nombre_producto',
               'source' =>['name'],
                  'unique' => true,
            ]
        ];
    }





 			public function belongsToManyMarcas()
	{
		return $this->belongsToMany('App\Marcas' , 'promocion_marcas', 'promocion_id' , 'marcas_id' );
	}



 			public function belongsToManyCategorias()
	{
		return $this->belongsToMany('App\Categoria1' , 'promocion_categorias', 'promocion_id' , 'categoria1_id');
	}




	     	   public function categoria1()
    {
        return $this->hasMany('App\Categoria1' , 'slug', 'cat1_id');
    }
             public function categoria2()
    {
        return $this->hasMany('App\Categoria2' , 'slug', 'cat2_id');
    }
             public function categoria3()
    {
        return $this->hasMany('App\Categoria3' , 'slug', 'cat3_id');
    }
             public function categoria4()
    {
        return $this->hasMany('App\Categoria4' , 'slug', 'cat4_id');
    }
             public function categoria5()
    {
        return $this->hasMany('App\Categoria5' , 'slug', 'cat5_id');
    }



             public function proveedor()
    {
        return $this->hasMany('App\Proveedores' , 'id', 'proveedor_id');
    }




}
