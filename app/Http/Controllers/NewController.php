<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Imgproductomodelo;
use App\Categorian1modelo;
use App\Categorian2modelo;
use App\Categorian3modelo;
use App\Categorian4modelo;
use App\Categorian5modelo;
use App\Imagenpromomodelo;
use App\Trmmodelo;
use Carbon\Carbon;
use App\Productomodelo;
use App\Categoria6;
use App\Categoria7;
use App\Slider;
use App\Marcas;
use DB;
use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use App\Parametromodelo;
use App\SlidersCategoria1;
use App\SlidersCategoria2;
use App\SlidersCategoria3;
use App\SlidersCategoria4;
use App\SlidersCategoria5;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Traits\SEOTrait;


class NewController extends Controller{

  use SEOTrait;

    
    public function sesion($grid){
        Session::put('grid', $grid);
        
        return redirect()->back();
    }
    
    
    public function index( $cat2=0 , $id, Request $request){
  $this->setSEOManager();

        

        //paginacion por defecto si en un futuo se va a parametrizar solo llamar ese dato de la bd
        $pagination=24;
        $chunk=24;
        //aca se busca si los productos con o sin inventario se mostraran en la tienda desde los parametros y van adicionados en un request para pasarlos como parametros al filtro. consultar documentacion eloquent filter
        $parametros=Parametromodelo::first();
        /*
        $store_show= $parametros->store_show;
        if ($store_show==true) {
            request()->merge(["show"=>'true']);
        }else{
            request()->merge(["show"=>'false']);
        }
        
        */
        $now=Carbon::now()->format('Y-m-d');
        $index=1;
        $grid=0;
        
        if (request()->search ){
            
            $searchData = request()->search ;
            
            $productos=Productomodelo::
            has('hasOneCategoria1')->
            filter( request()->all())
            ->search($searchData, null, true, true)
            ->paginateFilter(request()->mostrar);
            
            $productos2=Productomodelo::
            has('hasOneCategoria1')->
            filter( request()->all() )
            ->search($searchData, null, true, true)
            ->get();
            
            //   Session::put('id_categoria_principal', $id);
            
            
            $categorias= DB::table('categoria_n2')
            ->where('id_categorian1', $id)
            ->orderBy('nombrecategoria' ,  'asc')
            ->get();
            
            $categories=Categorian1modelo::
            orderBy('nombrecategoria', 'ASC')
            ->first();
            
        }else{

            $id_categoria_principal = session()->get('id_categoria_principal');
            switch ($cat2) {
                
                case 1:
                    //utilizo laravel eloquent when en vez de if else busca la documentacion
                    
                    $query = Productomodelo::
                    where('estado', true)
                    ->where('id_categorian1', '=', $id)
                    ->filter( request()->all() );
                    
                    
                    Session::put('id_categoria_principal', $id);
                    
                    $categorias= Categorian2modelo::
                    has('productos')->
                    where('id_categorian1', $id)
                    ->orderBy('nombrecategoria' ,  'asc')
                    ->get();
                    
                    $categorias_nombre= Categorian1modelo::
                    where('slug', '=', $id)
                    ->first();
                    
                    $categories=Categorian1modelo::
                    where('slug', $id)->
                    first();
     
                    
                    $marcas = DB::table('productos')
                    ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
                    ->select('marcas.id', 'marcas.nombre', 'marcas.img',  DB::raw('COUNT(cantidad) as cantidad'))
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian1', '=', $id)
                    ->where('estado', '=', '1')
                    ->groupBy('productos.id_marca')
                    ->orderBy('marcas.nombre')
                    ->get();
                    
                    
                    $ids2= Productomodelo::
                    where('estado', true)
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian1', '=', $id)
                    ->pluck('id');
                    
                break;
                
                case 2:
                    
                    $query = Productomodelo::
                    where('estado', true)
                    ->where('id_categorian2', '=', $id)
                    ->filter( request()->all() );
                    
                    
                    Session::put('id_categoria_principal', $id);
                    
                    $categorias=Categorian3modelo::
                    has('productos')->
                    where('id_categorian2', $id)
                    ->orderBy('nombrecategoria' ,  'asc')
                    ->get();
                    
                    $categorias_nombre= Categorian2modelo::
                    where('slug', '=', $id)
                    ->first();
                    
                    $categories=Categorian2modelo::
                    where('slug', $id)->
                    first();
                    
                    $marcas = DB::table('productos')
                    ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
                    ->select('marcas.id', 'marcas.nombre', 'marcas.img',  DB::raw('COUNT(cantidad) as cantidad'))
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian2', '=', $id)
                    ->where('estado', '=', '1')
                    ->groupBy('productos.id_marca')
                    ->orderBy('marcas.nombre')
                    ->get();
                    
                    
                    $ids2= Productomodelo::
                    where('estado', true)
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian2', '=', $id)
                    ->pluck('id');
                    
                break;
                
                case 3:
                    
                    $query = Productomodelo::
                    where('estado', true)
                    ->where('id_categorian3', '=', $id)
                    ->filter( request()->all() );
                    
                    /*
                    if($request->sort=='menor_mayor'){
                        $array=array();
                        foreach($query->get()->toArray() as $index => $product){
                            $real_price = precioNew($product['slug']);
                            $product['precioventa_iva'] = $real_price;
                            $array[] = $product;
                        }
                        
                        $collection =collect($array);
                        $query = $collection->sortBy('precioventa_iva') ;
                    }
                    */
                    //dd($query->get());
                    Session::put('id_categoria_principal', $id);
                    
                    $categorias=Categorian4modelo::
                    has('productos')->
                    where('id_categorian3', $id)
                    ->orderBy('nombrecategoria' ,  'asc')
                    ->get();
                    
                    $categorias_nombre= Categorian3modelo::
                    where('slug', '=', $id)
                    ->first();
                    
                    $categories=Categorian3modelo::
                    where('slug', $id)->
                    first();
                    
                    $marcas = DB::table('productos')
                    ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
                    ->select('marcas.id', 'marcas.nombre', 'marcas.img',  DB::raw('COUNT(cantidad) as cantidad'))
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian3', '=', $id)
                    ->where('estado', '=', '1')
                    ->groupBy('productos.id_marca')
                    ->orderBy('marcas.nombre')
                    ->get();
                    
                    
                    $ids2= Productomodelo::
                    where('estado', true)
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian3', '=', $id)
                    ->pluck('id');
                    
                    
                break;
                
                case 4:
                    
                    $query = Productomodelo::
                    where('estado', true)
                    ->where('id_categorian4', '=', $id)
                    ->filter( request()->all() );
                    
                    Session::put('id_categoria_principal', $id);
                    
                    $categorias= Categorian5modelo::
                    has('productos')->
                    where('id_categorian4', $id)
                    ->orderBy('nombrecategoria' ,  'asc')
                    ->get();
                    
                    $categorias_nombre= Categorian4modelo::
                    where('slug', '=', $id)
                    ->first();
                    
                    $categories=Categorian4modelo::
                    where('slug', $id)->
                    first();
                    
                    $marcas = DB::table('productos')
                    ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
                    ->select('marcas.id', 'marcas.nombre', 'marcas.img',  DB::raw('COUNT(cantidad) as cantidad'))
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian4', '=', $id)
                    ->where('estado', '=', '1')
                    ->groupBy('productos.id_marca')
                    ->orderBy('marcas.nombre')
                    ->get();
                    
                    
                    $ids2= Productomodelo::
                    where('estado', true)
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian4', '=', $id)
                    ->pluck('id');
                    
                break;
                
                case 5:
                    $query = Productomodelo::where('estado', true)
                    ->where('id_categorian5', '=', $id)
                    ->filter( request()->all() );
                    
                    Session::put('id_categoria_principal', $id);
                    
                    $categorias_nombre= Categorian5modelo::
                    where('slug', '=', $id)
                    ->first();
                    
                    $categorias= array();
                    
                    $categories=Categorian5modelo::
                    where('slug', $id)->
                    first();
                    
                    $marcas = DB::table('productos')
                    ->join('marcas', 'productos.id_marca', '=', 'marcas.id')
                    ->select('marcas.id', 'marcas.nombre', 'marcas.img',  DB::raw('COUNT(cantidad) as cantidad'))
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian5', '=', $id)
                    ->where('estado', '=', '1')
                    ->groupBy('productos.id_marca')
                    ->orderBy('marcas.nombre')
                    ->get();
                    
                    
                    $ids2= Productomodelo::
                    where('estado', true)
                    ->where('productos.cantidad', '!=', 0)
                    ->where('id_categorian5', '=', $id)
                    ->pluck('id');
                    
                break;
                
                case 'search':
                    
                    $query = Productomodelo::
                    where('estado', true)
                    //->where('id_marca', request()->marcas)
                    ->filter( request()->all() );
                    
                break;
            }
            
            $query->when($parametros->store_show== true, function ($q) {
                return $q;
            });
            $query->when($parametros->store_show== false, function ($q) {
                return $q->where('cantidad','>', 0);
            });
            
        }//end search
        
        
        $selected="";
        
        $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
        //  dd ($productos);
        
        
        $id_categoria_principal = session()->get('id_categoria_principal');
        
        $filtros=Productomodelo::with('categoria7')
        ->has('categoria7')
        ->get();
        
        
        $oldcat2=$cat2;
        
        
        if ($cat2 == 'search') {
            $cat2 = 0;
            
        }else{
            if ($cat2 >= 5) {
                $cat2 == 1;
            }else {
                $param=  Parametromodelo::first();
                if($categorias->count()  && ($param->categories_bar_position == 'left' ||  $param->categories_bar_position == 'both' )){
                    $cat2 = $cat2 + 1;
                }else{
                    //esta opcion es que la barra lateral se muestra
                    //y si se muestra entonces si mostrar los niveles si la categoria tiene pructos
                    $cat2 = $cat2;                    
                }
            }
        }
        
        
        
        Session::put('main', 0);
        
        $categoriasList=Categorian1modelo::
        orderBy('nombrecategoria' ,  'asc')
        ->get();
        
        /*TAREA 44*/
        
        
        $id_producto=array();
        
        
        if($categories->id_categorian1 ){
            $productos_principal=Productomodelo::
            where('estado', true)->
            with('hasManyImagenes')
            ->where('id_categorian2', '=', $categories->slug)
            ->get();
        }
        
        if($categories->id_categorian2){
            
            $productos_principal=Productomodelo::
            where('estado', true)->
            with('hasManyImagenes')
            ->where('id_categorian3', '=', $categories->slug)
            
            ->get();
            
        } 
        
        if($categories->id_categorian3){
            
            $productos_principal=Productomodelo::
            where('estado', true)->
            with('hasManyImagenes')
            ->where('id_categorian4', '=', $categories->slug)
            
            ->get();
            
        }     
        
        if($categories->id_categorian4){
            
            $productos_principal=Productomodelo::
            where('estado', true)->
            with('hasManyImagenes')
            ->where('id_categorian5', '=', $categories->slug)
            
            ->get();
            
        }    
        
        
        if(empty($productos_principal)){
            /*
            $productos_principal=Productomodelo::
            where('estado', true);
            */
        }
        //$id_producto = $productos_principal->pluck('id');
        
        $ids=$query->pluck('id');
        
        /*
        $marcas=Marcas::
        whereHas('belongsToManyProducts', function ($query) use ($ids ) {
            $query->whereIn('product_id', $ids );
        })
        ->orderBy('nombre', 'ASC')
        ->cursor();
        */
        
        
        // $marcas1=Marcas::
        // has('belongsToManyProducts')
        // ->get();
        
        
        
        $posts = Categoria6::
        whereHas('product', function ($productos) use ($ids2) {
            $productos->whereIn('product_id', $ids2);
        })
        ->orderBy('nombrecategoria', 'ASC')
        ->get(); // now we're working with a collection
        //->chunk(100);
        
        
        /*
        $posts = Categoria6::
        whereHas('product', function ($productos) use ($ids) {
            $productos->whereIn('product_id', $ids);
        })
        ->orderBy('nombrecategoria', 'ASC')
        ->cursor();
        */
        
        
        
        $checked=[];
        
        if (request()->marcas!=null) {
            $checked = explode (",", $request->marcas);
        }
        
        $filtros=[];
        
        if (request()->filtros!=null) {
            $filtros = explode (",", $request->filtros);
        }
        
        
        
        if (request()->range) {
            $prices = explode(',', request()->range);
            $min= $prices[0];
            $max= $prices[1];
        }else{
            
            $precios =[];
            foreach ($query->cursor() as $product) {
                $precios[] = precioNew($product->slug);
            }
            
            
            if (count($precios)<1) {
                
                $product=Productomodelo::
                where('estado', true)
                ->where('cantidad','>',0)
                ->get();
                
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
        
        
        
        
        
        
        $build=[];
        $filtrar_por=[];
        
        
        if(request()->marcas){
            $m = explode (",", $request->marcas);
            
            $filtrar_por_marcas=Marcas::whereIn('id', $m)->get();
        }
        
        $filtrar_por_marcas=[];
        if(request()->marcas){
            $m = explode (",", $request->marcas);
            $filtrar_por_marcas=Marcas::whereIn('id', $m)->get();
        }
        $filtrar_por_fitlers=[];
        if(request()->filtros){
            $f = explode (",", $request->filtros);
            $filtrar_por_fitlers=Categoria7::whereIn('id', $f )->get();
        }
        
        
        
        if (!isset($categorias_nombre)) {
            $categorias_nombre = collect(
                [
                    'nombrecategoria' =>'Resultados de la búsqueda',
                    ]);
                }
                
                $search_key=request()->search ;
                $cat_search=null;
                //dd($cat_search);
                
                
                //recolecto los id d etodos los productos que tienen relationcon cateogira 1 y luego en marcas.blade llamaruna relacion que cuenta
                //los productos asignados a esa marca que tengan categoria1 HasOneCategory1
                
                
                $sliders=collect([]);
                if ($oldcat2==1) {
                    $slider= SlidersCategoria1::where('category_id', $categorias_nombre->id)->get();
                    $slider_ids=[];
                    foreach ($slider as $sl) {
                        $slider_ids[]=$sl->slider_id;
                    }
                    $sliders=Slider::whereIn('id', $slider_ids )->get();
                }
                
                
                if ($oldcat2==2) {
                    
                    $slider= SlidersCategoria2::where('category_id', $categorias_nombre->id)->get();
                    $slider_ids=[];
                    foreach ($slider as $sl) {
                        $slider_ids[]=$sl->slider_id;
                    }
                    $sliders=Slider::whereIn('id', $slider_ids )->get();
                    
                }
                
                if ($oldcat2==3) {
                    $slider= SlidersCategoria3::where('category_id', $categorias_nombre->id)->get();
                    $slider_ids=[];
                    foreach ($slider as $sl) {
                        $slider_ids[]=$sl->slider_id;
                    }
                    $sliders=Slider::whereIn('id', $slider_ids )->get();
                }
                
                if ($oldcat2==4) {
                    $slider= SlidersCategoria4::where('category_id', $categorias_nombre->id)->get();
                    $slider_ids=[];
                    foreach ($slider as $sl) {
                        $slider_ids[]=$sl->slider_id;
                    }
                    $sliders=Slider::whereIn('id', $slider_ids )->get();
                }
                
                
                if ($oldcat2==5) {
                    $slider= SlidersCategoria5::where('category_id', $categorias_nombre->id)->get();
                    $slider_ids=[];
                    foreach ($slider as $sl) {
                        $slider_ids[]=$sl->slider_id;
                    }
                    $sliders=Slider::whereIn('id', $slider_ids )->get();
                }
                
                //dd("pp");
                                    

                return view('layouts.store')->with([
                    'sliders'=> $sliders,
                    'ids2'=> $ids2,
                    'categorias'=> $categorias,
                    'selected'=> $selected,
                    'productos'=> $query->paginateFilter($pagination),
                    'productos2'=> $query->cursor(),
                    'trmdeldia'=> $trmdeldia,
                    'cat2'=> $cat2,
                    'categorias_nombre'=> $categorias_nombre,
                    'index'=> $index,
                    'grid'=> $grid,
                    'idd'=> $id,
                    'oldcat2'=> $oldcat2,
                    'categoriasList'=> $categoriasList,
                    'projects'=> $posts,
                    'filtros'=> $filtros,
                    'marks'=> $request->marcas,
                    'ids'=> $ids,
                    'marcas'=> $marcas,
                    'checked'=> $checked,
                    'min'=> $min,
                    'max'=> $max,
                    'filtrar_por_fitlers'=> $filtrar_por_fitlers,
                    'filtrar_por_marcas'=> $filtrar_por_marcas,
                    'search_key' => $search_key,
                    'cat_search' => $cat_search,
                    ]);
                }
            }
            