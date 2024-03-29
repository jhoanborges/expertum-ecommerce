<?php
//Aqui nos conectamos anuestra tabla de ciudades para ser usada en el controlador y sus diferentes funciones
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
use DB;
use App\Marcas;
use EloquentFilter\Filterable;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Scout\Searchable;
use Laravel\Scout\Attributes\SearchUsingFullText;
use Laravel\Scout\Attributes\SearchUsingPrefix;

class Productomodelo extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;
    use Filterable;
    use Searchable;
    //https://github.com/jarektkaczyk/eloquence/wiki/Builder-searchable-and-more
    protected $table = 'productos';
    protected $fillable = [];
    public $timestamps = false;



    public function marca()
    {
        return $this->hasOne('App\Marcas', 'id', 'id_marca');
    }

    protected function makeAllSearchableUsing($query)
    {
        return $query->with('marca');
    }

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
        'nombre_producto' => $this->nombre_producto,
        'id_categorian1' => $this->id_categorian1,
        'id_categorian2' => $this->id_categorian2,
        'id_categorian3' => $this->id_categorian3,
        'id_categorian4' => $this->id_categorian4,
        'id_categorian5' => $this->id_categorian5,
    ];
}

/**
 * Determine if the model should be searchable.
 */
public function shouldBeSearchable(): bool
{
    return $this->categoria7();
}

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('estado', function (Builder $builder) {
            $builder->where('estado', true);
            $builder->orderBy('nombre_producto', 'ASC');
        });
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                //aca seria materile +  nombre de producto + marca
                'source' => 'nombre_producto'
                //'source' =>['referencia', 'nombre_producto']
            ]
        ];
    }



    public function promotionIsNotExpired($product)
    {
        dd($product);
    }

    /*
public function setPrecioVentaIvaAttribute($value)
{
  //$product = $this->where('slug', $value)->first();

    $this->attributes['precioventa_iva'] = precioNew($value);
}
*/
    /*
    public function searchableAs()
    {
        return 'productos_index';
    }
*/
    public function getMarcaProduct($id)
    {

        //$id2=DB::Table('imgproductos')->where('id' , $id)->select('id_producto')->value('id_producto');
        $id2 = Productomodelo::where('id', $id)->value('id');
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
        return $this->belongsToMany('App\Marcas', 'product_marcas', 'product_id', 'marca_id');
    }




    public function hasOneCategory1()
    {
        return $this->hasOne('App\Categorian1modelo', 'slug', 'id_categorian1');
    }


    public function hasOneCategory2()
    {
        return $this->hasOne('App\Categorian2modelo', 'slug', 'id_categorian2');
    }

    public function hasOneCategory3()
    {
        return $this->hasOne('App\Categorian3modelo', 'slug', 'id_categorian3');
    }

    public function hasOneCategory4()
    {
        return $this->hasOne('App\Categorian4modelo', 'slug', 'id_categorian4');
    }

    public function hasOneCategory5()
    {
        return $this->hasOne('App\Categorian5modelo', 'slug', 'id_categorian5');
    }


    public function productos()
    {
        return $this->belongsToMany('App\Productomodelo', 'product_categoria6s', 'product_id', 'categoria7_id');
    }


    //a que filtros pertenece
    public function filtros()
    {
        return $this->belongsToMany('App\Categoria6', 'product_categoria6s', 'product_id', 'categoria6_id');
    }


    /*    public function filtros()
    {
        return $this->hasMany('App\Categoria6');
    }
*/

    public function categories()
    {
        return $this->belongsToMany('App\Categoria6', 'categoria6_categoria7', 'categoria7_id', 'categoria6_id');
    }

    public function categoria7()
    {
        return $this->belongsToMany('App\Categoria7', 'product_categoria7s', 'product_id', 'categoria7_id');
    }

    /*
         public function filtros()
    {
        return $this->belongsToMany('App\Categoria6' , 'product_categoria6s', 'product_id' , 'categoria7_id' );
    }
*/

    public function scopeCategorized($query, Category $category = null)
    {
        if (is_null($category)) return $query->with('categories');

        $categoryIds = $category->getDescendantsAndSelf()->pluck('id');

        return $query->with('categories')
            ->join('products_categories', 'products_categories.productomodelo_id', '=', 'productos.id')
            ->whereIn('products_categories.category_id', $categoryIds);
    }

    public function promocion()
    {
        return $this->hasOne('App\Promociones', 'id', 'promocion_id');
    }
}
