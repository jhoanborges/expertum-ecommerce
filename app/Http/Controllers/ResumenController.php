<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Validator;
use Auth;
use App\ShoppingCart;
use App\Productomodelo;
use DB;
use Session;
use App\Categorian1modelo;
use Alert;

class ResumenController extends Controller
{
	public function index(){


//dd(Cart::instance('default')->content());

//verificar_si_producto_carrito_existe();

    //    dd(Cart::tax());
     //Cart::destroy();
        //dd(Cart::content());
		$total_iva=0;
		$subtotal=0;
		$qty_cont=0;
		foreach (Cart::content() as $i => $product){

      $valor_producto = precioNew($product->id)*$product->qty;
      $precio_base    = ($valor_producto  /  ($product->options->iva/100 +1));
      $subtotal       = $subtotal + $precio_base;
      $total_iva      = $total_iva + ($valor_producto - $precio_base );

      $id_producto = $product->options->id_producto;

    }


    $producto= Cart::instance('default')->content() ;

    $total=$total_iva+$subtotal;

    if (Auth::check()) {
     $id = Auth::id();
     ShoppingCart::deleteCartRecord($id, 'default');
     Cart::store($id);
   }

//   $categorias=Categorian1modelo::all();
   $cat2=1;

   $data=[];
   foreach ( Cart::instance('default')->content() as $product) {
     $data[]=[
      'id'=>$product->id,
      'qty'=>$product->qty,
      'price'=>formatPrice($product->price),
      'name'=>$product->name,
      'image'=>$product->options->imagen,
      'iva'=>$product->options->iva,
      'rowId'=>$product->rowId,
      'taxRate'=>$product->taxRate,
      'total'=>formatPrice(precioNew($product->id)),

    ];

  }


  return view('layouts.cart')->with([
   'totaliva' => $total_iva,
     //'total' => $total,
   'sub' => $subtotal,
   'cat2' => $cat2,
     //'categorias' => $categorias,
   'qty_cont' => $qty_cont,
   'producto' => $producto,
   'data' => $data,
        //   'cantidad' => $cantidad,

 ]);
}



public function store(Request $request)
{


  if (session()->get('ciudad')==null) {

    return redirect()->back()->with([
      'error_code'=> 5,
      'id'=> $request->id,
    ]);
  }else{


    $cantidad = Productomodelo::
    where('slug', $request->id)->value('cantidad');

    $validator = Validator::make($request->all(), [
      'qty' => 'required|numeric|integer|between:1,'.$cantidad,
    ]);
    if ($validator->fails()) {
        toastr()->info('La cantidad supera el inventario existente.'); // and this one
        return redirect()->back();
      }



      $duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
            //return $cartItem->id === $request->id;

        if ($cartItem->id == $request->id) {

         if ($request->qty <= $cartItem->qty){
        toastr()->info('Este producto ya existe en el carrito'); // and this one
        //toast('Este producto ya existe en el carrito','info','top-right')
        //->showConfirmButton()
        //->autoClose(20000);

        return redirect()->back()->with('test', 'test');
      }

      if ($request->qty > $cartItem->qty){

             Cart::update($rowId, $request->qty); // Will update the quantity
             toastr()->success('Cantidad actualizada'); 
             return redirect()->route('resumen');
           }
         }
       });


      if ($duplicates->isEmpty()) {

        $producto= Productomodelo::with('hasManyImagenes')->
        where('slug',$request->id)->first();

        $cartItem = Cart::add($producto->slug ,$producto->nombre_producto , $request->qty , $producto->precioventa_iva,
          0, [
           'iva' => $producto->iva,
           'imagen' =>  $producto->hasManyImagenes->first()->urlimagen ,
         ])->associate('App\Imgproductomodelo');

        if ($request->type=='checkout') {
          toastr()->success('Producto añadito al carrito'); 
          return redirect()->route('resumen');

        }else{
          toastr()->success('Producto añadito al carrito'); 
          return redirect()->back();
        }

      }else{
        return redirect()->back();
      }


}//else session
}


public function destroy($id)
{

 Cart::remove($id);

 if (Auth::check()) {
  $id_2 = Auth::id();
  ShoppingCart::deleteCartRecord($id_2, 'default');
  Cart::store($id_2);
}
toastr()->info('Producto eliminado del carrito de compras'); 
return back();
}

public function update(Request $request, $id)
{
  try{


    foreach (Cart::instance('default')->content() as $product) {
      if ($id == $product->rowId) {
        $id_producto=$product->id;
      }
    }

    $producto= Productomodelo::where('slug',$id_producto)->first();
    $validator= Validator::make($request->all(),[

      'cantidad'=>'required|numeric|between:1,'.$producto->cantidad,
    ]);

    if ($validator->fails()) {
      return response()->json([
        'error'=>'La cantidad ingresada supera el inventario existente'
      ], 404);
    }

    Cart::update($id, $request->cantidad);
    return response()->json(['success'=>'Cantidad actualizada']);

  }catch(\Exception $e){
    return response()->json(['error'=>'Error inesperado'], 404);
  }




}


}
