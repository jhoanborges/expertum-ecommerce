<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Categorian1modelo;
use App\Categoria6;
use App\Categoria7;
use App\Monedas;
use App\Parametromodelo;
use Session;
use App\Productomodelo;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Trm;
use App\Traits\SEOTrait;
use Spatie\SchemaOrg\Schema as SchemaSpatie;
use Spatie\SchemaOrg\Graph;


class ProductController extends Controller
{
  use SEOTrait;


  public function show($id)
  {
    $now=Carbon::now()->format('Y-m-d');
    $filters=[];

    $selection=Productomodelo::where('slug',$id)->first()->categoria7;
    $filtros = $selection->pluck('id', 'nombrecategoria');
    $categoria6= Categoria6::pluck('id', 'nombrecategoria');
//$filtros = Categoria7::whereIn('id', $array)->pluck('id', 'nombrecategoria');
 // return response()->json($filtros);
    $productos=Productomodelo::with('categories')->where('slug', $id)->first()->categoria7;
    foreach ($productos as $sel) {
      $cat6=Categoria7::find($sel->pivot->categoria7_id)->categories->first();

      $cat7 = $cat6->pivot->categoria7_id ?? null;
      $cat6= $cat6->pivot->categoria6_id ?? null;
      $categoria7 = Categoria7::where('id', $cat7)->first();
      $categoria6 = Categoria6::where('id', $cat6)->first();

      $filters[] = collect([
        'categoria6' => $categoria6->nombrecategoria ?? null,
        'categoria7' => $categoria7->nombrecategoria ?? null
   // 'id' =>  $categoria7->id
      ]);
    }


    $productos=Productomodelo::
    //with('hasManyImagenes')
    //->with('hasManyPromociones')
//->with('categoria7')
    where('slug',(string) $id)->first();




    $allImages= Productomodelo::where('slug',(string) $id)->first()
    ->hasManyImagenes()
    ->get();



    $destacados = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(5)
    ->groupBy('productos.referencia')
    ->get();


    $imagenpromocion =DB::table('imgpromociones')->get();

    $count=$allImages->count();
    $trmdeldia =Trm::where('fecha' , $now)->orderBy('id', 'DESC')->first();
    $categorias=Categorian1modelo::all();
    $cat2=1;


    Session::put('main', 0);


    // Si el producto no tiene imagen y doy click sale error "Undefined offset: 0"
    // entonces obligo a que pase por esta línea solo cuando el produto tenga imagen
    if (count($allImages) > 0){
      $this->setSEOManagerShow($productos, $filters, $allImages);
    }


    $param = Parametromodelo::first();
    $product = $productos;
    /*
    $graph = new Graph();

    $graph
    ->organization()
    ->name($param->nombre_tienda);

    $graph
    ->product()
    ->name($product->nombre_producto)
    ->brand($graph->organization());


//$mte->hotelRoom()->name('The Presidential Suite');
$graph->product()->offers(
  SchemaSpatie::offer()
        ->name($product->nombre_producto)
        ->price($product->precioventa_iva)
        ->priceCurrency($product->id_moneda)
);
$schema_org = $graph->toScript();
*/
$moneda = Monedas::where('id', $productos->id_moneda)->first();


    return view ('layouts.product')->with([
      //'schema_org'=> $schema_org,
      'producto'=> $productos,
      'moneda'=> $moneda,
      'allImages'=> $allImages,
        // 'imagen'=> $imagen,
      'destacados' =>$destacados,
      'count' =>$count,
                      //'top' =>$top,
      'cat2' =>$cat2,
      'categorias' =>$categorias,
      'imagenpromocion' =>$imagenpromocion,
      'trmdeldia' =>$trmdeldia,
                             //'imagenprincipal' =>$imagenprincipal,
      'filters' =>$filters,
    ]);
  }

}
