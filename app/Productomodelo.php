<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;
use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Marcas;
use EloquentFilter\Filterable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;


class Productomodelo extends Model
{
 use Sluggable;
  use SluggableScopeHelpers;
   use Filterable;
    use SearchableTrait;
//https://github.com/jarektkaczyk/eloquence/wiki/Builder-searchable-and-more
    protected $table = 'productos';
  protected $fillable = [];
	public $timestamps = false;

      protected $searchable = [
        'columns' => [
            'productos.nombre_producto' => 10,
            'productos.alias_producto' => 10,
            'productos.referencia' => 10,
            'productos.referencia_propia' => 10,
            'productos.descripcion_larga' => 10,
            'productos.descripcion' => 10,
             'marcas.nombre' => 10,
             'categoria_n1.nombrecategoria' => 10,
             'categoria_n2.nombrecategoria' => 10,
             'categoria_n3.nombrecategoria' => 10,
             'categoria_n4.nombrecategoria' => 10,
             'categoria_n5.nombrecategoria' => 10,
        ],
        'joins' => [
 'marcas' => ['productos.id_marca','marcas.id'],
 'categoria_n1' => ['productos.id_categorian1','categoria_n1.slug'],
 'categoria_n2' => ['productos.id_categorian2','categoria_n2.slug'],
 'categoria_n3' => ['productos.id_categorian3','categoria_n3.slug'],
 'categoria_n4' => ['productos.id_categorian4','categoria_n4.slug'],
 'categoria_n5' => ['productos.id_categorian5','categoria_n5.slug'],
        ],
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'nombre_producto'
                                //'source' =>['referencia', 'nombre_producto']
            ]
        ];
    }
/*
    public function searchableAs()
    {
        return 'productos_index';
    }
*/
    public function getMarcaProduct($id)
  {

  //$id2=DB::Table('imgproductos')->where('id' , $id)->select('id_producto')->value('id_producto');
    $id2=Productomodelo::where('id' , $id)->value('id');
$query =  Marcas::whereHas('belongsToManyProducts', function ($query) use ($id2) {
    $query->where('product_id', $id2);
})->first();

    return $query;
  }

  public function hasPromotion()
  {
    return $this->hasMany('App\Promociones', 'id', 'id_promocion');

  }




  public function hasManyPromociones()
  {
    return $this->hasMany('App\Promociones', 'id', 'promocion_id');
  }


  public function hasManyImagenes()
  {
    return $this->hasMany('App\Imgproductomodelo', 'slug', 'slug');
  }


  public function hasOneCategoria1()
  {
    return $this->hasOne('App\Productomodelo', 'id_categorian1', 'id_categorian1');
  }


  public function belongsToManyMarcas()
  {
    return $this->belongsToMany('App\Marcas' , 'product_marcas', 'product_id' , 'marca_id' );
  }




         public function hasOneCategory1()
    {
        return $this->hasOne('App\Categorian1modelo' , 'slug', 'id_categorian1');
    }


         public function hasOneCategory2()
    {
        return $this->hasOne('App\Categorian2modelo' , 'slug', 'id_categorian2');
    }

         public function hasOneCategory3()
    {
        return $this->hasOne('App\Categorian3modelo' , 'slug', 'id_categorian3');
    }

             public function hasOneCategory4()
    {
        return $this->hasOne('App\Categorian4modelo' , 'slug', 'id_categorian4');
    }

             public function hasOneCategory5()
    {
        return $this->hasOne('App\Categorian5modelo' , 'slug', 'id_categorian5');
    }


         public function productos()
    {
        return $this->belongsToMany('App\Productomodelo' , 'product_categoria6s', 'product_id' , 'categoria7_id' );
    }


//a que filtros pertenece
        public function filtros()
    {
        return $this->belongsToMany('App\Categoria6', 'product_categoria6s', 'product_id' , 'categoria6_id'  );
    }


/*    public function filtros()
    {
        return $this->hasMany('App\Categoria6');
    }
*/

             public function categories()
    {
        return $this->belongsToMany('App\Categoria6' , 'categoria6_categoria7', 'categoria7_id' , 'categoria6_id' );
    }

       public function categoria7()
    {
        return $this->belongsToMany('App\Categoria7' , 'product_categoria7s', 'product_id' , 'categoria7_id' );
    }

    /*
         public function filtros()
    {
        return $this->belongsToMany('App\Categoria6' , 'product_categoria6s', 'product_id' , 'categoria7_id' );
    }
*/

  public function scopeCategorized($query, Category $category=null) {
    if ( is_null($category) ) return $query->with('categories');

    $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

    return $query->with('categories')
      ->join('products_categories', 'products_categories.productomodelo_id', '=', 'productos.id')
      ->whereIn('products_categories.category_id', $categoryIds);
  }


}
