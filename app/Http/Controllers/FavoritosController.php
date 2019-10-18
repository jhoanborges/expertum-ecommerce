<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Auth;
use App\ShoppingCart;
use Carbon\Carbon;
use DB;
use App\Categorian1modelo;
use App\Productomodelo;

class FavoritosController extends Controller
{
    public function index()
    {

   //   $email = Auth::user()->email;
         // ShoppingCart::deleteFavoriteCartRecord($email, 'favoritos');
      //   Cart::instance('favoritos')->restore($email);


$productos= Cart::instance('favoritos')->content() ;
$ids=[];
foreach ($productos as $cart) {
$ids[]=$cart->id;

}

$producto= Productomodelo::   
with('hasManyImagenes')->
//join('imgproductos', 'productos.id', 'imgproductos.id_producto')->
//whereIn('imgproductos.id',$ids)->get();
whereIn('slug',$ids)->get();


    //dd(Cart::instance('favoritos')->content() );
/*$categorias=Categorian1modelo::all();
$cat2=1;


          $email = Auth::user()->email;
          ShoppingCart::deleteFavoriteCartRecord($email, 'favoritos');
         Cart::instance('favoritos')->store($email);
*/
/*
      $email = Auth::user()->email;
          ShoppingCart::deleteFavoriteCartRecord($email, 'favoritos');
         Cart::instance('favoritos')->store($email);
*/

         /*
          $email = Auth::user()->email;
         Cart::instance('favoritos')->restore($email);
*/


   $email = Auth::user()->email;
    ShoppingCart::deleteFavoriteCartRecord($email, 'favoritos');
   Cart::instance('favoritos')->store($email);

         //dd($producto);
        return view('layouts.favoritos')->with([
      //    'categorias' =>$categorias,
       //   'cat2' =>$cat2,
          'producto' =>$producto,
        ]);
    }


    //public function store($id, $referencia, Request $request)
        public function store($id, $referencia, Request $request)
    {

            $user = Auth::user()->email;
            ShoppingCart::deleteFavoriteCartRecord($user, 'favoritos');
            Cart::instance('favoritos')->store($user);

            //dd( Cart::instance('favoritos')->content() );
        $duplicates = Cart::instance('favoritos')->search(function ($cartItem, $rowId) use ($request) {

            return $cartItem->id === intval($request->id);
        });

        if ($duplicates->isNotEmpty()) {
            toast('Este producto ya existe en tus favoritos','warning','top-right');
            return redirect()->back();
        }
        

//dd ( Cart::instance('favoritos')->content() );

$producto= Productomodelo::
where('slug', $request->id)
//join('imgproductos', 'productos.id', 'imgproductos.id_producto')
//->where('imgproductos.id',$id)
->first();

//dd($producto);

Cart::instance('favoritos')->add($producto->slug ,$producto->nombre_producto , 1 , $producto->precioventa_iva);



/*
Cart::instance('favoritos')->add($producto->id ,$producto->nombre_producto , 1 , $producto->precioventa_iva , [
           // 'id_producto' => $producto->id,
           // 'iva' => $producto->iva,
           // 'referencia' => $producto->referencia,
           // 'id_provedor' => $producto->id_provedor,
           // 'descripcionproducto' => $producto->descripcion_larga,
           // 'cantidad' => $producto->cantidad,
           // 'promocion' => $producto->promocion,
           // 'garantia' => $producto->garantia,
           // 'id_moneda' => $producto->id_moneda,
           //   'imagen' => $producto->urlimagen,
        ])->associate('App\Imgproductomodelo');
*/

/*
if ($request) {
        Cart::instance('favoritos')->add($request->id ,$request->name , 1 , $request->price , [
            'id_producto' => $request->id,
            'iva' => $request->iva,
            'referencia' => $request->referencia,
            'id_provedor' => $request->id_provedor,
            'descripcionproducto' => $request->descripcion_larga,
            'cantidad' => $request->cantidad,
            'promocion' => $request->promocion,
            'garantia' => $request->garantia,
            'id_moneda' => $request->id_moneda,
              'imagen' => $request->imagen,
        ])->associate('App\Imgproductomodelo');
}
*/

        alert()->success('Éxito', 'Producto añadito a tus favoritos');
        return redirect()->route('favoritos');
        //return back()->with('alert', 'Producto añadito a tu lista de deseos.');
    }


    public function destroy(Request $request)
    {


foreach ( Cart::instance('favoritos') ->content()  as $favorito) {
  if ($favorito->id == $request->id) {
 $id=  $favorito->rowId;
  }
}


            Cart::instance('favoritos')->remove($id);
            
            $user = Auth::user()->email;
            ShoppingCart::deleteFavoriteCartRecord($user, 'favoritos');
            Cart::instance('favoritos')->store($user);

        


        toast('Producto eliminado de tus favoritos','success','top-right');
        return redirect()->back();
    }


    public function swichtToCheckout($id)
    {
 
/*
$now=Carbon::now()->format('Y-m-d');
$trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->get();

$producto = Cart::instance('favoritos')->content()->get($id);

if($producto->options->id_moneda == 1 && $trmdeldia->isEmpty() ){
      toast('El producto no se encuentra disponible','info','top-right');
       return redirect()->route('favoritos');
}else{
*/

$productos= Cart::instance('favoritos')->content() ;

foreach ($productos as $cart) {

  if ($cart->id == $id) {
    $rowId=$cart->rowId;
  }
}




        $request=Cart::instance('favoritos')->get($rowId);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($id) {
            return $cartItem->id === $id;
        });
        if ($duplicates->isNotEmpty()) {
           toast('Este producto ya existe en tu carrito de compras','info','top-right');
           return redirect()->route('favoritos');
       }



$producto= Productomodelo::with('hasManyImagenes')->
where('slug',$request->id)->first();

            $cartItem = Cart::add($producto->slug ,$producto->nombre_producto , $request->qty , $producto->precioventa_iva , [
              'iva' => $producto->iva,
                    'imagen' =>  $producto->hasManyImagenes->first()->urlimagen ,
            ])->associate('App\Imgproductomodelo');



/*
       Cart::instance('default')->add($request->id ,$request->name , 1 , $request->price , [
        'id_producto' => $request->id,
        'iva' => $request->options->iva,
        'referencia' => $request->options->referencia,
        'id_provedor' => $request->options->id_provedor,
        'descripcionproducto' => $request->options->descripcion_larga,
        'cantidad' => $request->options->cantidad,
        'promocion' => $request->options->promocion,
        'garantia' => $request->options->garantia,
        'id_moneda' => $request->options->id_moneda,
        'imagen' => $request->options->imagen,
    ])->associate('App\Imgproductomodelo');
*/



  Cart::instance('favoritos')->remove($rowId);

       toast('Producto movido al carrito de compras','success','top-right');
       return redirect()->route('favoritos');
 
 //  }
   
   }







   public function swichtToFavorite($id)
   {



    $request=Cart::instance('default')->get($id);

 Cart::instance('default')->remove($id);
//verificar si el producto ya existe en el carrito
    $duplicates = Cart::instance('favoritos')->search(function ($cartItem, $rowId) use ($id) {

        return $cartItem->id === $id;
    });

 


    if ($duplicates->isNotEmpty()) {
       toast('Este producto ya existe en tus favoritos','info','top-right');
       return redirect()->route('resumen');
   }

//dd($request);
   $producto= Productomodelo::with('hasManyImagenes')->
where('slug',$request->id)->first();

Cart::instance('favoritos')->add($request->id ,$request->name , 1 , $producto->precioventa_iva);
    
/*
   Cart::instance('favoritos')->add($request->id ,$request->name , 1 , $request->price , [
    'id_producto' => $request->id,
    'iva' => $request->options->iva,
    'referencia' => $request->options->referencia,
    'id_provedor' => $request->options->id_provedor,
    'descripcionproducto' => $request->options->descripcion_larga,
    'cantidad' => $request->options->cantidad,
    'promocion' => $request->options->promocion,
    'garantia' => $request->options->garantia,
    'id_moneda' => $request->options->id_moneda,
           'imagen' => $request->options->imagen,
])->associate('App\Imgproductomodelo');
*/
 
   toast('Producto agregado a favoritos','success','top-right');
   return redirect()->route('resumen');


}

public function create()
{
        //
}


public function show($id)
{
        //
}

public function edit($id)
{
        //
}

public function update(Request $request, $id)
{
        //
}
}
