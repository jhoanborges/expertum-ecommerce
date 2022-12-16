<?php
namespace App\ModelFilters;

use EloquentFilter\ModelFilter;
use App\Marcas;
use App\Productomodelo;
use Macroable;
use Illuminate\Support\Collection;
use App\Parametromodelo;

class ProductomodeloFilter extends ModelFilter
{

  public $relations = [
    'productos' => ['categoria7', 'product_categoria6s'],
  ];







  public function categoria($id)
  {

    return $this->where('category_id', 13);
  }

  public function sort($sort)
  {
  /*  
    $products=array();
    foreach($this->get()->toArray() as $index => $product){
      $real_price = precioNew($product['slug']);
      $product['precioventa_iva'] = $real_price;
      $products[] = $product;
    }
    
    $collection =collect($products);
dd( $collection->sortBy('precioventa_iva') );
*/
    if ( $sort=='menor_mayor' ) {
//return $collection->sortBy('precioventa_iva') ;

      return $this->orderBy('precioventa_iva', 'asc');
    }


    if ( $sort=='mayor_menor' ) {
      return $this->orderBy('precioventa_iva', 'desc');
    }


  }


    /*
  public function mayor_menor($mayor_menor)
    {


    return $this->orderBy('precioventa_iva', 'desc');
    }
*/
    public function filtro($destacado)
    {

      return $this->where('destacado', true)->orderBy('destacado', true);

    }



    public function mostrar($mostrar)
    {

      return $this->paginate($mostrar);

    }

    public function marcas($marcas)
    {
  
      $ids = explode(',', $marcas);

      $query = $this->whereHas('belongsToManyMarcas', function ($q) use ($ids)
      {
        //$q->orWhereIn('marca_id', $ids);
          $q->whereIn('marca_id', $ids);
      });

/*
       $query = Marcas::whereHas('belongsToManyProducts', function ($q) use ($ids)
        {
            $q->whereIn('marca_id', $ids);
            });
*/

            return $query->get();



      //  return $this->paginate($marcas);

          }



          public function filtros($filtros)
          {

            $ids = explode(',', $filtros);

//cambie where has a orWhereHas para obtener todos los resultados de los filtrod
            $query = $this::
            has('hasOneCategoria1')->
            whereHas('categoria7', function ($q) use ($ids)
            {
              $q->whereIn('categoria7_id', $ids);
            })->get();

            return $query;
          }




          public function order($order)
          {

            if ($order=='asc') {

              return $this->orderBy('nombre_producto', 'ASC');
            }

            if ($order=='desc') {


              return $this->orderBy('nombre_producto', 'DESC');
            }



          }






          public function range($range)
          {

            $parametros=Parametromodelo::first();
            $prices = explode(',', $range);
            $query = $this;

            $query->when($parametros->store_show== true, function ($q) {
              return $q;
            });
            $query->when($parametros->store_show== false, function ($q) {
              return $q->where('cantidad','>', 0);
            });

            $productos = $query->get();

//en esta parte agregue un campo trm price para calcular los productos con la trm y no los precios originales en precioventa_iva
//SOLUCION OPTIMA-> EDITA LA COLECCION E INTRODUCE EL VALOR TEMPORARIO
            $trm_price=[];

/*
    foreach ($productos as $product) {
    $data =  Productomodelo::where('id', $product->id)->update([
      'trm_price'=>precioNew($product->slug),
      ]);
    }
//return $this->whereBetween('trm_price',[ floatval($prices[0]), floatval($prices[1]) ]);
*/
    return $this->whereBetween('precioventa_iva',[ floatval($prices[0]), floatval($prices[1]) ]);

  }




/*
  public function show($show)
  {
    if ($show=='false') {
      return $this->where('cantidad', '!=' , 0);
    }else{

  //return $this;
    }

  }
*/





}
