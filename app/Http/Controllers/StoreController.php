<?php

namespace App\Http\Controllers;
Use Alert;
use DB;
use Session;
use Illuminate\Http\Request;
use App\Promociones;
use App\Parametromodelo;
use App\Productomodelo;
use App\Imgproductomodelo;
use App\Categorian1modelo;
use App\Categorian2modelo;
use App\Categorian3modelo;
use App\Categorian4modelo;
use App\Categorian5modelo;
use App\Imagenpromomodelo;
use App\Trmmodelo;
use Validator;
use App\Category;
use App\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Categoria6;
use App\Marcas;
use App\Categoria7;
use App\Traits\SEOTrait;
use Illuminate\Support\Arr;

class StoreController extends Controller
{
  use SEOTrait;

  public function index(Request $request){

    $index=0;
    $now=Carbon::now()->format('Y-m-d');

    $pagination= 0;
    $mostrar="12";

    if (request()->mostrar=='12') {
      $pagination= 12;
      $mostrar="12";
    }
    if (request()->mostrar=='8') {
      $pagination= 8;
      $mostrar="8";
    }
    if (request()->mostrar=='24') {
      $pagination= 24;
      $mostrar="24";
    }
    if (request()->mostrar=='2') {

      $pagination= 2;
      $mostrar="2";
    }
    $filtros = Categoria6::with('categories')->get();

    $categorias=Categorian1modelo::all();

    $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
    $productos=Productomodelo::
    join('categoria_n1', 'categoria_n1.id', 'productos.id_categorian1')
    ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
  //  ->where('productos.destacado' , true)
 //->orderBy('productos.nombre_producto' , 'desc')
    ->groupBy('productos.referencia')
    ->take($pagination);

    $marcas = DB::table('marcas')->orderBy('nombre' ,'asc')->take(10)->get();

    $top = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(2)
    ->groupBy('productos.referencia')
    ->get();

    $destacados = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(5)
    ->groupBy('productos.referencia')
    ->get();

    $categorias_principales = Category::where('parent_id' , 0)->orWhereNull('parent_id')
    ->orderBy('name' , 'asc')
    ->get();

//$categories = Category::all()->toHierarchy();

    $imagenpromocion =DB::table('imgpromociones')->get();
    $selected="";


    if (request()->filtro == 'menor_mayor') {
     // $productos=$productos->orderBy('precioventa_iva', request()->filtro ?? 'destacado')->paginate($pagination);
     $productos=$productos->orderBy('precioventa_iva', 'asc')->paginate($pagination);
     $selected="menor_mayor";


   } elseif (request()->filtro == 'mayor_menor') {
     $productos=$productos->orderBy('precioventa_iva', 'desc')->paginate($pagination);
     $selected="mayor_menor";

   } else if (request()->filtro=='destacado') {
     $productos=$productos
     ->where('productos.destacado' , true)->paginate($pagination);
     $selected="destacados";

   }else {
     $productos=$productos->inRandomOrder()->paginate($pagination);
   }


   $filtros = Categoria6::with('categories')
   ->orderBy('nombrecategoria' ,  'asc')->get();

   $oldcat2=null;
   $categorias=Categorian1modelo::orderBy('nombrecategoria' ,   'asc')->get();
   $cat2=1;
   $id=null;

   if ($request->filtros) {

    $categoria7 = Categoria7::find($request->filtros);
    $productos= $categoria7->productos()->filter(request()->all())
    ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
    ->select('productos.*', 'imgproductos.*')
    ->groupBy('productos.referencia')
    ->paginateFilter(request()->mostrar);
     //  dd(request()->all());
  }


  Session::put('main', 0);

  return view('layouts.store')->with([
    'marcas'=> $marcas,
    'top'=> $top,
    'categorias_principales'=> $categorias_principales,
    'productos'=> $productos,
    'destacados'=> $destacados,
    'imagenpromocion'=> $imagenpromocion,
    'selected'=> $selected,
    'mostrar'=> $mostrar,
      //  'categories'=> $categories,
    'categorias'=> $categorias,
    'trmdeldia'=> $trmdeldia,
    'cat2'=> $cat2,
    'index'=> $index,
    'id'=> $id,
    'oldcat2'=> $oldcat2,
    'projects'=> $filtros,
    'filtros'=> $request->filtros,


  ]);
}





















public function index2(){

  $pagination= 0;
  $mostrar="12";

  if (request()->mostrar=='12') {
    $pagination= 12;
    $mostrar="12";

  }else if (request()->mostrar=='24') {
    $pagination= 24;
    $mostrar="24";
  }else if (request()->mostrar=='2') {
    $pagination= 2;
    $mostrar="2";
  }



  if (request()->categoria) {

    $productos=Productomodelo::join('categoria_n1', 'categoria_n1.id', 'productos.id_categorian1')
    ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
    ->where('productos.id_categorian1', request()->categoria) ->take(12);

    $marcas = DB::table('marcas')
    ->orderBy('nombre' ,'asc')->take(10)->get();


    $top = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(2)
    ->groupBy('productos.referencia')
    ->get();

    $destacados = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(5)
    ->groupBy('productos.referencia')
    ->get();

    $categorias_principales = DB::table('categoria_n1')
    ->orderBy('nombrecategoria' , 'asc')
    ->get();

  }else{

    $productos=Productomodelo::join('categoria_n1', 'categoria_n1.id', 'productos.id_categorian1')
    ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')->take(12);


    $marcas = DB::table('marcas')
    ->orderBy('nombre' ,'asc')->take(10)
    ->get();

    $top = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(2)
    ->groupBy('productos.referencia')
    ->get();



    $destacados = DB::table('productos')
    ->join('imgproductos', function ($join) {
      $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
    ->where('productos.destacado', '=', true)
    ->take(5)
    ->groupBy('productos.referencia')
    ->get();

    $categorias_principales = DB::table('categoria_n1')
    ->orderBy('nombrecategoria' , 'asc')
    ->get();


        }//endif
        $imagenpromocion =DB::table('imgpromociones')->get();


        $selected="";


        if (request()->filtro=='menor_mayor') {
         $productos=$productos->orderBy('precioventa_iva', 'asc')->paginate($pagination);
         $selected="menor_mayor";

       } else if (request()->filtro=='mayor_menor') {
         $productos=$productos->orderBy('precioventa_iva', 'desc')->paginate($pagination);
         $selected="mayor_menor";

       } else if (request()->filtro=='destacados') {
         $productos=$productos->orderBy('destacados', true)->paginate($pagination);
         $selected="destacados";
       } else{
         $productos=$productos->inRandomOrder()->paginate($pagination);
       }


       return view('layouts.store_list')->with([
        'marcas'=> $marcas,
        'top'=> $top,
        'categorias_principales'=> $categorias_principales,
        'productos'=> $productos,
        'destacados'=> $destacados,
        'imagenpromocion'=> $imagenpromocion,
        'selected'=> $selected,
        'mostrar'=> $mostrar,
      ]);

     }





     public function search(Request $request){

      $pagination=24;

      $validator = Validator::make($request->all(), [
        'search' => 'required|min:2',
      ]);

      if ($validator->fails()) {
        alert()->error('Error','Debe ingresar mas de 1 caracter para la búsqueda');
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
      }


      $searchData= $request->search;

      $parametros=Parametromodelo::first();

      if(!$request->categoria==null){
        $query = Productomodelo::has('hasOneCategory1')
        -> filter( request()->all())
        ->where('estado', true)->where('productos.id_categorian1', '=', $request->categoria);
        $query->when($parametros->store_show== true, function ($q) {
          return $q;
        });
        $query->when($parametros->store_show== false, function ($q) {
          return $q->where('cantidad','>', 0);
        });
        $query = $query->search($searchData, null, true)->paginateFilter($pagination);
        $q = Productomodelo::has('hasOneCategory1')
        -> filter( request()->all())
        ->where('estado', true)->where('productos.id_categorian1', '=', $request->categoria);
        $q->when($parametros->store_show== true, function ($q) {
          return $q;
        });
        $q->when($parametros->store_show== false, function ($q) {
          return $q->where('cantidad','>', 0);
        });

        $productos2 = $q->search($searchData, null, true)->get();

      }else{


        if($request->strict == true){

         $query=Productomodelo::
         whereHas('categoria7', function ($query) use ($searchData) {
           $query->where('nombrecategoria', $searchData);
         })
         ->orderBy('nombre_producto' , 'ASC');

       }else{
         $query = Productomodelo::has('hasOneCategory1')
         -> filter( request()->all())
         ->where('estado', true)
         ->orderBy('nombre_producto' , 'ASC');

       }

       $query->when($parametros->store_show== true, function ($q) {
        return $q;
      });
       $query->when($parametros->store_show== false, function ($q) {
        return $q->where('cantidad','>', 0);
      });

       if(!$request->has('strict')){
        $query = $query->search($searchData, null, true);
      }

    }

    $ids=array();

    foreach ($query->get() as $key) {
      $ids[]=$key->id;
    }

    $posts = Categoria6::
    whereHas('product', function ($productos) use ($ids) {
     $productos->whereIn('product_id', $ids);
   })->get();



    $marcas=Marcas::
    whereHas('belongsToManyProducts', function ($query) use ($ids) {
     $query->whereIn('product_id', $ids);
   })
    ->orderBy('nombre', 'ASC')
    ->get();


    $selected="";
    $mostrar="12";

    $categorias=Categorian1modelo::all();
    $now=Carbon::now()->format('Y-m-d');
    $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
    $oldcat2=null;
    $cat2=1;
    $id=null;

    $cont_mark= $marcas->count();

    $categorias_nombre =null;
    $filtrar_por_marcas=[];
    $filtrar_por_fitlers=[];


    if (request()->range) {

      $prices = explode(',', request()->range);
      $min= floatval($prices[0]);
      $max= floatval($prices[1]);

      $query = $query->where('precioventa_iva' ,'>=' , $min - 1)
      ->where('precioventa_iva' ,'<=' , $max - 1);
    }else{

     $precios =[];
     foreach ($query->get() as $product) {
      $precios[] = precioNew($product->slug);
    }
    if (count($precios)<1) {

      $product=Productomodelo::all();
      $new_p =[];
      foreach ($product as $product_price) {
       $new_p[] = precioNew($product_price->slug);
     }


     if(empty($new_p) ){
      $min=min([0]);
      $max= max([0]);
    }else{
      $min=min($new_p);
      $max= max($new_p);
    }


  }else{
   $min= min($precios) ;
   $max= max($precios) ;

 }

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}


return view('layouts.store')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'searchData'=> $searchData,
  'marcas'=> $marcas,
       // 'categorias_principales'=> $categorias_principales,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
    //'categorias'=> $categorias,
    //'categorias'=> [], //devuelvo vacio para que no aparezcan las categorias en los resultados de busqueda
  'categorias_nombre'=> $categorias_nombre,

  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids,
  'min'=> $min,
  'max'=> $max,
  'search_key'=> $searchData,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
  'strict'=> $request->strict,
]);
}










public function categoria_get($id)
{


  $index=1;
  $selected="";
  $pagination= 0;
  $mostrar="12";
  $imagenpromocion =DB::table('imgpromociones')->get();


  $marcas = DB::table('marcas')
  ->orderBy('nombre' ,'asc')->take(10)
  ->get();

  $top = DB::table('productos')
  ->join('imgproductos', function ($join) {
    $join->on('productos.id', '=', 'imgproductos.id_producto');
  })
  ->where('productos.destacado', '=', true)
  ->take(2)
  ->groupBy('productos.referencia')
  ->get();
  $destacados = DB::table('productos')
  ->join('imgproductos', function ($join) {
    $join->on('productos.id', '=', 'imgproductos.id_producto');
  })
  ->where('productos.destacado', '=', true)
  ->take(5)
  ->groupBy('productos.referencia')
  ->get();


  $categorias_principales = Category::where('parent_id' , 0)->orWhereNull('parent_id')
  ->orderBy('name' , 'asc')
  ->get();


  $parent_id=Category::where('id' , $id)->value('id');
  $root=Category::where('id' , $id)->value('parent_id');

  $category = Category::find($id);
  $productos = Productomodelo::categorized($category)
  ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
  ->paginate($pagination);

  //}

  $categorias_nombre = Category::where('id' , $id)->select('name')->first();

  $categories = Category::all()->toHierarchy();

  return view('layouts.store')->with([
    'categorias_principales' =>$categorias_principales ,
       // 'category_details' =>$category_details ,
    'productos'=> $productos,

    'imagenpromocion'=> $imagenpromocion,
    'marcas'=> $marcas,
    'top'=> $top,
    'destacados'=> $destacados,
    'categorias_nombre'=> $categorias_nombre,


    'selected'=> $selected,
    'pagination'=> $pagination,
    'mostrar'=> $mostrar,
    'categories'=> $categories,

    'index'=> $index,
      //  'next'=> $next,



  ]);
}




















public function novedades(Request $request){

  $this->setSEOManager();

  $pagination=24;
  $parametros=Parametromodelo::first();

  $query = Productomodelo::
  where('estado', true)
  ->where('novedad', true);

  $ids=array();

  foreach ($query->get() as $key) {
    $ids[]=$key->id;
  }

  $posts = Categoria6::
  whereHas('product', function ($productos) use ($ids) {
   $productos->whereIn('product_id', $ids);
 })->get();



  $marcas=Marcas::
  whereHas('belongsToManyProducts', function ($query) use ($ids) {
   $query->whereIn('product_id', $ids);
 })
  ->orderBy('nombre', 'ASC')
  ->get();


  $selected="";
  $mostrar="12";

  $categorias=Categorian1modelo::all();
  $now=Carbon::now()->format('Y-m-d');
  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
  $oldcat2=null;
  $cat2=1;
  $id=null;

  $cont_mark= $marcas->count();

  $categorias_nombre =null;
  $filtrar_por_marcas=[];
  $filtrar_por_fitlers=[];


  if (request()->range) {
    $prices = explode(',', request()->range);
    $min= $prices[0];
    $max= $prices[1];
  }else{

   $precios =[];
   foreach ($query->get() as $product) {
    $precios[] = precioNew($product->slug);
  }
  if (count($precios)<1) {

    $product=Productomodelo::all();
    $new_p =[];
    foreach ($product as $product_price) {
     $new_p[] = precioNew($product_price->slug);
   }


   if(empty($new_p) ){
    $min=min([0]);
    $max= max([0]);
  }else{
    $min=min($new_p);
    $max= max($new_p);
  }


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}


return view('layouts.offers')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'marcas'=> $marcas,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
  'categorias'=> $categorias,
  'categorias_nombre'=> $categorias_nombre,
  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids,
  'min'=> $min,
  'max'=> $max,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
]);

}


public function novedades_filter(Request $request){



  $pagination=24;
  $parametros=Parametromodelo::first();


  $query = Productomodelo::
  where('estado', true)
  ->where('novedad', true)
  -> filter( request()->all());



  $ids=array();

  foreach ($query->get() as $key) {
    $ids[]=$key->id;
  }

  $posts = Categoria6::
  whereHas('product', function ($productos) use ($ids) {
   $productos->whereIn('product_id', $ids);
 })->get();



  $marcas=Marcas::
  whereHas('belongsToManyProducts', function ($query) use ($ids) {
   $query->whereIn('product_id', $ids);
 })
  ->orderBy('nombre', 'ASC')
  ->get();




  $selected="";
  $mostrar="12";

  $categorias=Categorian1modelo::all();
  $now=Carbon::now()->format('Y-m-d');
  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
  $oldcat2=null;
  $cat2=1;
  $id=null;

  $cont_mark= $marcas->count();

  $categorias_nombre =null;
  $filtrar_por_marcas=[];
  $filtrar_por_fitlers=[];


  if (request()->range) {
    $prices = explode(',', request()->range);
    $min= $prices[0];
    $max= $prices[1];
  }else{

   $precios =[];
   foreach ($query->get() as $product) {
    $precios[] = precioNew($product->slug);
  }
  if (count($precios)<1) {

    $product=Productomodelo::all();
    $new_p =[];
    foreach ($product as $product_price) {
     $new_p[] = precioNew($product_price->slug);
   }


   if(empty($new_p) ){
    $min=min([0]);
    $max= max([0]);
  }else{
    $min=min($new_p);
    $max= max($new_p);
  }


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}


return view('layouts.offers')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'marcas'=> $marcas,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
  'categorias'=> $categorias,
  'categorias_nombre'=> $categorias_nombre,
  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids,
  'min'=> $min,
  'max'=> $max,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
]);

}












public function masvendidos(Request $request){

  $this->setSEOManager();

  $pagination=24;
  $parametros=Parametromodelo::first();

  $query = Productomodelo::
  where('estado', true)
  ->where('destacado', true);

  $ids=array();

  foreach ($query->get() as $key) {
    $ids[]=$key->id;
  }

  $posts = Categoria6::
  whereHas('product', function ($productos) use ($ids) {
   $productos->whereIn('product_id', $ids);
 })->get();



  $marcas=Marcas::
  whereHas('belongsToManyProducts', function ($query) use ($ids) {
   $query->whereIn('product_id', $ids);
 })
  ->orderBy('nombre', 'ASC')
  ->get();


  $selected="";
  $mostrar="12";

  $categorias=Categorian1modelo::all();
  $now=Carbon::now()->format('Y-m-d');
  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
  $oldcat2=null;
  $cat2=1;
  $id=null;

  $cont_mark= $marcas->count();

  $categorias_nombre =null;
  $filtrar_por_marcas=[];
  $filtrar_por_fitlers=[];


  if (request()->range) {
    $prices = explode(',', request()->range);
    $min= $prices[0];
    $max= $prices[1];
  }else{

   $precios =[];
   foreach ($query->get() as $product) {
    $precios[] = precioNew($product->slug);
  }
  if (count($precios)<1) {

    $product=Productomodelo::all();
    $new_p =[];
    foreach ($product as $product_price) {
     $new_p[] = precioNew($product_price->slug);
   }


   if(empty($new_p) ){
    $min=min([0]);
    $max= max([0]);
  }else{
    $min=min($new_p);
    $max= max($new_p);
  }


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}


return view('layouts.offers')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'marcas'=> $marcas,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
  'categorias'=> $categorias,
  'categorias_nombre'=> $categorias_nombre,
  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids,
  'min'=> $min,
  'max'=> $max,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
]);

}







public function masvendidos_filter(Request $request){



  $pagination=24;
  $parametros=Parametromodelo::first();


  $query = Productomodelo::
  where('estado', true)
  ->where('destacado', true)
  -> filter( request()->all());



  $ids=array();

  foreach ($query->get() as $key) {
    $ids[]=$key->id;
  }

  $posts = Categoria6::
  whereHas('product', function ($productos) use ($ids) {
   $productos->whereIn('product_id', $ids);
 })->get();



  $marcas=Marcas::
  whereHas('belongsToManyProducts', function ($query) use ($ids) {
   $query->whereIn('product_id', $ids);
 })
  ->orderBy('nombre', 'ASC')
  ->get();




  $selected="";
  $mostrar="12";

  $categorias=Categorian1modelo::all();
  $now=Carbon::now()->format('Y-m-d');
  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
  $oldcat2=null;
  $cat2=1;
  $id=null;

  $cont_mark= $marcas->count();

  $categorias_nombre =null;
  $filtrar_por_marcas=[];
  $filtrar_por_fitlers=[];


  if (request()->range) {
    $prices = explode(',', request()->range);
    $min= $prices[0];
    $max= $prices[1];
  }else{

   $precios =[];
   foreach ($query->get() as $product) {
    $precios[] = precioNew($product->slug);
  }
  if (count($precios)<1) {

    $product=Productomodelo::all();
    $new_p =[];
    foreach ($product as $product_price) {
     $new_p[] = precioNew($product_price->slug);
   }


   if(empty($new_p) ){
    $min=min([0]);
    $max= max([0]);
  }else{
    $min=min($new_p);
    $max= max($new_p);
  }


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}


return view('layouts.offers')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'marcas'=> $marcas,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
  'categorias'=> $categorias,
  'categorias_nombre'=> $categorias_nombre,
  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids,
  'min'=> $min,
  'max'=> $max,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
]);

}






















public function ofertas(Request $request){

  $this->setSEOManager();

  $pagination=24;
  $parametros=Parametromodelo::first();

  //productos relacionados
  $promociones = Promociones::
  with('productos')->get();

$productsWithPromo = [];
  $date = Carbon::now();

  foreach ($promociones as $key => $promocion) {
    //try{
      //si algo falla aca olvidalo.. continua
    $start = Carbon::parse($promocion->start);
    $end = Carbon::parse($promocion->end);

 $check = Carbon::now()->between($start, $end);
 if($check == true){
          $productsWithPromo []= $promocion->productos;
 }

  }//foreach
/*
eq() equals
ne() not equals
gt() greater than
gte() greater than or equals
lt() less than
lte() less than or equals
*/
$productsWithPromo = Arr::collapse($productsWithPromo);
$ids = [];
foreach($productsWithPromo as $productPromo){
  $ids []= $productPromo->id;
}


$query = Productomodelo::
whereIn('id',$ids)
->where('cantidad', '>',0)
->with('promocion')
->has('promocion');


/*

$query = Productomodelo::
    where('estado', true)
    ->where('promocion_id', '!=' , null)
    ->with('promocion')
    ->has('promocion');

*/

//dd($query->get());
$posts = Categoria6::
whereHas('product', function ($productos) use ($ids) {
 $productos->whereIn('product_id', $ids);
})->get();



$marcas=Marcas::
whereHas('belongsToManyProducts', function ($query) use ($ids) {
 $query->whereIn('product_id', $ids);
})
->orderBy('nombre', 'ASC')
->get();


$selected="";
$mostrar="12";

$categorias=Categorian1modelo::all();
$now=Carbon::now()->format('Y-m-d');
$trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
$oldcat2=null;
$cat2=1;
$id=null;

$cont_mark= $marcas->count();

$categorias_nombre =null;
$filtrar_por_marcas=[];
$filtrar_por_fitlers=[];


if (request()->range) {
  $prices = explode(',', request()->range);
  $min= $prices[0];
  $max= $prices[1];
}else{

 $precios =[];
 foreach ($query->get() as $product) {
  $precios[] = precioNew($product->slug);
}
if (count($precios)<1) {

  $product=Productomodelo::all();
  $new_p =[];
  foreach ($product as $product_price) {
   $new_p[] = precioNew($product_price->slug);
 }


 if(empty($new_p) ){
  $min=min([0]);
  $max= max([0]);
}else{
  $min=min($new_p);
  $max= max($new_p);
}


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}

$ids2= Productomodelo::
where('estado', true)
->with('hasManyImagenes')
->where('productos.cantidad', '!=', 0)
//->where('id_categorian1', '=', $id)
->pluck('id');


return view('layouts.offers')->with([
  'productos'=> $query->paginate($pagination),
  'productos2'=> $query->get(),
  'marcas'=> $marcas,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
  'categorias'=> $categorias,
  'categorias_nombre'=> $categorias_nombre,
  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids2,
  'min'=> $min,
  'max'=> $max,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
]);

}









public function ofertas_filter(Request $request){



  $pagination=24;
  $parametros=Parametromodelo::first();

  $promociones = Promociones::
  with('productos')->get();

$productsWithPromo = [];
  $date = Carbon::now();

  foreach ($promociones as $key => $promocion) {
    //try{
      //si algo falla aca olvidalo.. continua
    $start = Carbon::parse($promocion->start);
    $end = Carbon::parse($promocion->end);

 $check = Carbon::now()->between($start, $end);
 if($check == true){
          $productsWithPromo []= $promocion->productos;
 }

  }//foreach
/*
eq() equals
ne() not equals
gt() greater than
gte() greater than or equals
lt() less than
lte() less than or equals
*/
$productsWithPromo = Arr::collapse($productsWithPromo);
$ids = [];
foreach($productsWithPromo as $productPromo){
  $ids []= $productPromo->id;
}




  $query = Productomodelo::
whereIn('id',$ids)
->with('promocion')
->has('promocion')
  -> filter( request()->all());
    //->orWhere('estado', true)
    //->where('promocion', true);

  $posts = Categoria6::
  whereHas('product', function ($productos) use ($ids) {
   $productos->whereIn('product_id', $ids);
 })->get();



  $marcas=Marcas::
  whereHas('belongsToManyProducts', function ($query) use ($ids) {
   $query->whereIn('product_id', $ids);
 })
  ->orderBy('nombre', 'ASC')
  ->get();




  $selected="";
  $mostrar="12";

  $categorias=Categorian1modelo::all();
  $now=Carbon::now()->format('Y-m-d');
  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
  $oldcat2=null;
  $cat2=1;
  $id=null;

  $cont_mark= $marcas->count();

  $categorias_nombre =null;
  $filtrar_por_marcas=[];
  $filtrar_por_fitlers=[];


  if (request()->range) {
    $prices = explode(',', request()->range);
    $min= $prices[0];
    $max= $prices[1];
  }else{

   $precios =[];
   foreach ($query->get() as $product) {
    $precios[] = precioNew($product->slug);
  }
  if (count($precios)<1) {

    $product=Productomodelo::all();
    $new_p =[];
    foreach ($product as $product_price) {
     $new_p[] = precioNew($product_price->slug);
   }


   if(empty($new_p) ){
    $min=min([0]);
    $max= max([0]);
  }else{
    $min=min($new_p);
    $max= max($new_p);
  }


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}

$ids2= Productomodelo::
where('estado', true)
->with('hasManyImagenes')
->where('productos.cantidad', '!=', 0)
//->where('id_categorian1', '=', $id)
->pluck('id');


return view('layouts.offers')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'marcas'=> $marcas,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
  'categorias'=> $categorias,
  'categorias_nombre'=> $categorias_nombre,
  'filtrar_por_marcas'=> $filtrar_por_marcas,
  'filtrar_por_fitlers'=> $filtrar_por_fitlers,
  'cont_mark'=> $cont_mark,
  'projects'=> $posts,
  'ids'=> $ids,
  'ids2'=> $ids2,
  'min'=> $min,
  'max'=> $max,
  'cat_search' => $request->categoria,
  'idd'=> $idd,
  'checked'=> $checked,
  'search_like'=> $search_like,
]);

}







public function searchFilter(Request $request){

  $pagination=24;

  $validator = Validator::make($request->all(), [
    'search' => 'required|min:2',
  ]);

  if ($validator->fails()) {
    alert()->error('Error','Debe ingresar mas de 1 caracter para la búsqueda');
    return redirect()->back()
    ->withErrors($validator)
    ->withInput();
  }


  $searchData= $request->search;

  $parametros=Parametromodelo::first();

  $query=Productomodelo::
  whereHas('categoria7', function ($query) use ($searchData) {
   $query->where('nombrecategoria', $searchData);
 });

  $query->when($parametros->store_show== true, function ($q) {
    return $q;
  });
  $query->when($parametros->store_show== false, function ($q) {
    return $q->where('cantidad','>', 0);
  });

  $ids=array();
  foreach ($query->get() as $key) {
    $ids[]=$key->id;
  }


  $posts = Categoria6::
  whereHas('product', function ($productos) use ($ids) {
   $productos->whereIn('product_id', $ids);
 })->get();



  $marcas=Marcas::
  whereHas('belongsToManyProducts', function ($query) use ($ids) {
   $query->whereIn('product_id', $ids);
 })
  ->orderBy('nombre', 'ASC')
  ->get();


  $selected="";
  $mostrar="12";

  $categorias=Categorian1modelo::all();
  $now=Carbon::now()->format('Y-m-d');
  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
  $oldcat2=null;
  $cat2=1;
  $id=null;

  $cont_mark= $marcas->count();

  $categorias_nombre =null;
  $filtrar_por_marcas=[];
  $filtrar_por_fitlers=[];

  if (request()->range) {

    $prices = explode(',', request()->range);
    $min= $prices[0];
    $max= $prices[1];
  }else{

   $precios =[];
   foreach ($query->get() as $product) {
    $precios[] = precioNew($product->slug);
  }



  if (count($precios)<1) {

    $product=Productomodelo::all();
    $new_p =[];
    foreach ($product as $product_price) {
     $new_p[] = precioNew($product_price->slug);
   }


   if(empty($new_p) ){
    $min=min([0]);
    $max= max([0]);
  }else{
    $min=min($new_p);
    $max= max($new_p);
  }


}else{
 $min= min($precios) ;
 $max= max($precios) ;

}

}



$idd=$request->categoria;
$oldcat2='search';


if (!empty ($query->get()) ) {
  $search_like=Productomodelo::
  has('hasOneCategory1')->
  where('estado', true)->take(6)
  ->paginateFilter($pagination);
}

$checked=[];
if ($request->marcas) {
  $array_ = explode(',', $request->marcas);
  $checked = $array_;
}


return view('layouts.store')->with([
  'productos'=> $query->paginateFilter($pagination),
  'productos2'=> $query->get(),
  'searchData'=> $searchData,
  'marcas'=> $marcas,
       // 'categorias_principales'=> $categorias_principales,
  'selected'=> $selected,
  'pagination'=> $pagination,
  'mostrar'=> $mostrar,
  'cat2'=> $cat2,
  'id'=> $id,
  'oldcat2'=> $oldcat2,
  'trmdeldia'=> $trmdeldia,
    //'categorias'=> $categorias,
    'categorias'=> [], //devuelvo vacio para que no aparezcan las categorias en los resultados de busqueda
    'categorias_nombre'=> $categorias_nombre,

    'filtrar_por_marcas'=> $filtrar_por_marcas,
    'filtrar_por_fitlers'=> $filtrar_por_fitlers,
    'cont_mark'=> $cont_mark,
    'projects'=> $posts,
    'ids'=> $ids,
    'ids2'=> $ids,
    'min'=> $min,
    'max'=> $max,
    'search_key'=> $searchData,
    'cat_search' => $request->categoria,
    'idd'=> $idd,
    'checked'=> $checked,
    'search_like'=> $search_like,
  ]);
}




}