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
use App\Product;

class ResumenController extends Controller
{

  
  public function deleteItemFromCart(Request $request)
{
$id = $request->id;

 Cart::remove($id);
/*
 if (Auth::check()) {
  $id_2 = Auth::id();
  ShoppingCart::deleteCartRecord($id, 'default');
  Cart::store($id_2);
}*/

return response()->json([
  'success'=>false,
  'message' =>'Producto eliminado del carrito de compras.'
],200);
}



  public function updateCartQuantity(Request $request){

    //inventario del producto existente
    $product = Productomodelo::where('slug', $request->product_id)->first();
    if(!$product){
      return response()->json([
        'success'=>false,
        'message' =>'Este producto no existe o se ha borrado del inventario.'
      ],404);
    }


    $validator = Validator::make($request->all(), [
      'id' => 'required',
      'qty' => 'required|numeric|integer|between:1,'.($product->cantidad),
    ]);
    if ($validator->fails()) {
      return response()->json([
        'success'=>false,
        'message' =>'La cantidad supera el inventario existente.'
      ],404);
      }//if fails validator

      Cart::update($request->id, $request->qty);

      return response()->json([
        'success'=>false,
        'message' =>'Cantidad actualizada.'
      ],200);
  }

    public function getCartProducts(){

      $total_iva=0;
      $subtotal=0;
      $qty_cont=0;
      
    $products = [];
    foreach( Cart::instance('default')->content() as $product){
    $price = precioNew($product->id);

      $products[] =[
        'id'=>$product->id,
        'qty'=>$product->qty,
        'price'=> $price,
        'name'=>$product->name,
        'image'=>$product->options->imagen,
        'brand'=>$product->options->brand,
        'iva'=>$product->options->iva,
        'iva'=>$product->options->iva,
        'rowId'=>$product->rowId,
        'taxRate'=>$product->taxRate,
        'total'=> $price * $product->qty 
      ];


  
        $valor_producto = $price*$product->qty;
        $precio_base    = ($valor_producto  /  ($product->options->iva/100 +1));
        $subtotal       = $subtotal + $precio_base;
        $total_iva      = $total_iva + ($valor_producto - $precio_base );

    }

    $total= $total_iva + $subtotal;

    return response()->json( [
      'products'=>$products,
      'total_iva'=>$total_iva,
      'subtotal'=>$subtotal,
      'total'=>$total,
      ] , 200);
  }
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

    $price = precioNew($product->id);
     $data[]=[
      'id'=>$product->id,
      'qty'=>$product->qty,
      'price'=> $price,
      'name'=>$product->name,
      'image'=>$product->options->imagen,
      'iva'=>$product->options->iva,
      'rowId'=>$product->rowId,
      'taxRate'=>$product->taxRate,
      'total'=> $price * $product->qty 
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
      'qty'=> $request->qty,
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
        with('promocion')
        ->where('slug',$request->id)->first();

        $precio_final = $producto->precioventa_iva;
        if($producto->promocion()->exists()){
          $precio_final =  old_price($producto['slug']);
        }

//dd($producto->hasManyImagenes->first());

        if ($producto->hasManyImagenes->first()){
          $cartItem = Cart::add($producto->slug ,$producto->nombre_producto , $request->qty ,$precio_final ,
            0, [
             'precioventa_iva' => $producto->precioventa_iva,
             'iva' => $producto->iva,
             'imagen' =>  $producto->hasManyImagenes->first()->urlimagen ,
             'promocion' =>  $producto->promocion()->first() ,
            ])->associate('App\Imgproductomodelo');
        }else{
            $cartItem = Cart::add($producto->slug ,$producto->nombre_producto , $request->qty , $precio_final,
            0, [
             'precioventa_iva' => $producto->precioventa_iva,
             'iva' => $producto->iva,
             'imagen' =>  image('') ,
             'promocion' =>  $producto->promocion()->first() ,
            ])->associate('App\Imgproductomodelo');
        }

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
