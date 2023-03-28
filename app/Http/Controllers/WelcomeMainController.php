<?php

namespace App\Http\Controllers;

Use Alert;
use DB;
use App\Category;
use Session;
use Illuminate\Http\Request;
use App\Productomodelo;
use App\Imgproductomodelo;
use App\Categorian1modelo;
use App\Categorian2modelo;
use App\Categorian3modelo;
use App\Categorian4modelo;
use App\Categorian5modelo;
use App\Categoria6;
use App\Imagenpromomodelo;
use App\Trmmodelo;

use Validator;
use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use App\Slider;
use App\Notifications\SendMessageToAdmin;
use Notification;
use App\Parametromodelo;
use App\Traits\SEOTrait;

class WelcomeMainController extends Controller
{
  use SEOTrait;

  public function clear()
  {
    Cart::instance('default')->destroy();
    toast('Carrito de compras limpiado','success','top-right');
    return redirect()->route('welcome');
}


public function send_mail(Request $request)
{


    $rules = [
        'email'     => "required|email|max:50",
        'name'     => "required|max:50",
        'message'     => "required|max:250",
        'my_name'   => 'honeypot',
        'my_time'   => 'required|honeytime:5'
    ];



    $messages = [
    //'required' => 'El campo :attribute es requerido.',
        'name.required' => 'El campo nombre es requerido.',
        'name.max' => 'El campo nombre supera la cantidad de caracteres permitidos',
        'email.max' => 'El campo email supera la cantidad de caracteres permitidos',
        'email.required' => 'El campo email es requerido.',
        'message.max' => 'El campo mensaje supera la cantidad de caracteres permitidos',

        'my_name.honeypot' => 'Spam detectado',
        'my_time.honeytime' => 'Spam detectado. Muchas peticiones simultáneas',

    ];


    $validator = Validator::make($request->all(), $rules, $messages);



    if ($validator->fails()) {
           //return ['error' => true, 'message' => 'Email not sent!!'];
        return response()->json( ['error' => true,
           'message' => 'Email not sent!!',
           'validations' => $validator->getMessageBag()->toArray(),
       ] , 401 );
    }else{
        $email = Parametromodelo::first()->correo;
        //abajo colocar $email esta mi correo como prueba
        Notification::route('mail', 'radioactiveboyx@gmail.com')->notify(new SendMessageToAdmin( $request->all()  ));
        return ['success' => true, 'message' => 'Email sent!!'];
    }

}



public function index()
{
  $this->setSEOManager();


  $slider= Slider::where('principal', true)->get();
  $now=Carbon::now()->format('Y-m-d');

  $pagination= 40;


        //$pagination= 0;
  $mostrar="12";


  if (request()->mostrar=='12') {
            //$pagination= 12;
    $mostrar="12";
}
if (request()->mostrar=='24') {
            //$pagination= 24;
    $mostrar="24";
}
if (request()->mostrar=='2') {
            //$pagination= 2;
    $mostrar="2";
}

if (request()->categoria) {

    $productos=Productomodelo::join('categoria_n1', 'categoria_n1.id', 'productos.id_categorian1')
    ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
    ->where('productos.id_categorian1', request()->categoria) ->take($pagination);

    $marcas = DB::table('marcas')
    ->orderBy('nombre' ,'asc')->take(10)->get();

    $top=Productomodelo::
    where('productos.destacado', '=', true)
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

    $categorias2=Categorian1modelo::has('productos')->
    orderBy('nombrecategoria' ,  'asc')
    ->take($pagination);
//dd($categorias2->first());
    $marcas = DB::table('marcas')
    ->orderBy('nombre' ,'asc')->take(10)
    ->get();

    $top=Productomodelo::
    where('productos.destacado', '=', true)
    ->get()->take(3);

    $destacados = DB::table('productos')
    ->join('imgproductos', function ($join) {
        $join->on('productos.id', '=', 'imgproductos.id_producto');
    })->where('productos.destacado', '=', true)
    ->take(5)
    ->groupBy('productos.referencia')
    ->get();


        }//endif



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
            $categorias2=$categorias2->paginate($pagination);
        }

        $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();
//$categories = Category::all()->toHierarchy();
        $index=0;

//variable para que el breadcrumb no se muestre en la pagina de inicio
        Session::put('main', 1);


 //dd(Cart::content());
 //Cart::destroy();
//dd(Cart::content()->count());

        $cat_search=null;
/*
        $categories=Categorian1modelo::
        where('slug', $id)->
        first();
  */



        $ids2= Productomodelo::
        where('estado', true)
        ->with('hasManyImagenes')
        ->where('productos.cantidad', '!=', 0)
    //->where('id_categorian1', '=', $id)
        ->pluck('id');


        $projects = Categoria6::
        whereHas('product', function ($productos) use ($ids2) {
            $productos->whereIn('product_id', $ids2);
        })
        ->orderBy('nombrecategoria', 'ASC')
        ->get();

        $filtros = Categoria6::
    //with('categories')
        where('is_shown_in_home_screen', 1)
        ->get();

    //operaciones para contar si los filtros, categorias y demas
    //son iguales a cero, si son cero, entonces
    //el panel de inicio col-lg-2 no se muestra para que el numero de
    //columnas sea igual a 12, es decir que se muestre en pantalla completa

        //se que hay mejor manera de hacerlo..
        //pero me desespere asi que voy checando cada condicion
        //comparando si show pane es true... si ya es true se muestra independientemente
        //de las otras validaciones
        $show_pane = false;
    //1. empezamos con los filtros
        foreach ($filtros as $key => $data) {

        //si este filtro se muestra en la pantalla principal activar flag
            if($data->show_on_sidebar == true){
                $show_pane = true;
            }
        // code...
        }


        $parametros = getParams();

        if($show_pane == false){
    //2. sino se muestran destacados  tambien esconder
            if($parametros->show_featued_on_side == true){

                $show_pane = true;
            }

        }

        if($show_pane == false){

    //3. validamos las categorias
            if($parametros->categories_bar_position == 'left' ||  $parametros->categories_bar_position == 'both' ){
                $show_pane = true;
            }
    //si alguna de estas condiciones se cumple, entonces no se muestra la columna izquierda
        }



        return view('layouts.home')->with([
            'show_pane'=> $show_pane,
            'filters'=> $filtros,
            'ids2'=> $ids2,
            'marcas'=> $marcas,
            'top'=> $top,
            'categorias2'=> $categorias2,
            'destacados'=> $destacados,
            'index'=>$index,
            'selected'=> $selected,
            'mostrar'=> $mostrar,
            'trmdeldia'=> $trmdeldia,
            // 'categoriasList' => $categoriasList,
            'sliders'=> $slider,
            'cat_search'=> $cat_search,
            'projects'=> $projects,
            'cat2'=>1,


     //         'categories'=> $categories,
        ]);
        //return view('partials.main_index');
    }







    public function index_old()
    {


        $pagination= 0;
        $mostrar="12";


        if (request()->mostrar=='12') {
            $pagination= 12;
            $mostrar="12";
        }
        if (request()->mostrar=='24') {
            $pagination= 24;
            $mostrar="24";
        }
        if (request()->mostrar=='2') {
            $pagination= 2;
            $mostrar="2";
        }

        if (request()->categoria) {

            $productos=Productomodelo::join('categoria_n1', 'categoria_n1.id', 'productos.id_categorian1')
            ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
            ->where('productos.id_categorian1', request()->categoria) ->take($pagination);

/*
     $productos=DB::table('productos')
     ->join('categoria_n1', 'categoria_n1.id', 'productos.id_categorian1')
     ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
     ->where('productos.id_categorian1', request()->categoria) ->paginate($pagination);*/

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

    $categorias=Categorian1modelo::take($pagination);

/*
$categorias_cantidad= DB::table('categoria_n1')
     ->join('productos', 'categoria_n1.id', '=', 'productos.id_categorian1')
     ->select('cantidad')->get();
dd($categorias_cantidad);
    */
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
/*

     $productos = DB::table('productos')
     ->join('imgproductos', function ($join) {
        $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
     ->where('productos.destacado', '=', true)
     ->take(5)
     ->groupBy('productos.referencia')
     ->paginate($pagination);
*/
     $destacados = DB::table('productos')
     ->join('imgproductos', function ($join) {
        $join->on('productos.id', '=', 'imgproductos.id_producto');
    })
     ->where('productos.destacado', '=', true)
     ->take(5)
     ->groupBy('productos.referencia')
     ->get();

/*
     $categorias_principales = DB::table('categoria_n1')
     ->orderBy('nombrecategoria' , 'asc')
     ->get();
*/
     /*
$categorias_principales = Category::with('children')->where(['parent_id' =>0])->get();
dd($categorias_principales);
*/
$categorias_principales = Category::where('parent_id' , 0)->orWhereNull('parent_id')
->orderBy('name' , 'asc')
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
            $categorias=$categorias->paginate($pagination);
        }

        $trmdeldia =DB:: table('trm')->select('valor_trm')->orderBy('id', 'DESC')->value('valor_trm');
        $categories = Category::all()->toHierarchy();


        return view('layouts.main')->with([
            'marcas'=> $marcas,
            'top'=> $top,
            'categorias_principales'=> $categorias_principales,
            'categorias'=> $categorias,
            'destacados'=> $destacados,
            'imagenpromocion'=> $imagenpromocion,
            'selected'=> $selected,
            'mostrar'=> $mostrar,
            'trmdeldia'=> $trmdeldia,
            'categories'=> $categories,

        ]);
        //return view('partials.main_index');
    }


}
