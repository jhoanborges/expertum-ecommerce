<?php

use DB as DB;
use App\Productomodelo;
use  Carbon\Carbon as Carbon;
use Gloudemans\Shoppingcart\Facades\Cart as Cart;


use App\Transportadores;
use App\ShoppingCart;
use App\Estados;
use App\Ciudades;
use App\Proveedores_Trans;
use App\User;



function formatPrice($price) {
    //$data = number_format((float)$price, 2, '.', ',');
  //sin coma sin decimales
    $data = number_format((float)$price, 0, '', '.');
    return $data;
}




//por especificaciones del servidor otra vez, file_get_contents no esta disponivble aca un workaround
function url_get_contents ($Url) {
    if (!function_exists('curl_init')){
        die('CURL is not installed!');
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $Url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $output = curl_exec($ch);
    curl_close($ch);
    return $output;
}



function totaliva($slug) {
  $product=Productomodelo::where('slug', $slug)->first();
  $product_iva=$product->iva/100;

  if ($product_iva <= 0) {
     return 0;
 }

 $iva=$product->precioventa_iva * $product_iva;

 return $iva;

}

function removeCaps($str) {
  $text = mb_convert_case($str, MB_CASE_TITLE, "UTF-8");
//$text = ucwords(strtolower($str)); // All Caps
  return $text;
}





function removeAccents2($string) {
  return strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', preg_replace('~&([a-z]{1,2})(acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'))), ' '));
}



function remove_accents($string)
{
  $title = $string;
  $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
  $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
  $cadena= str_replace($search, $replace, $title);

  return $cadena;
}


function image($path)
{

  if( empty($path) ){

    return asset('images/no_products_found.jpg');
}else{

    try{
     $header =  url_get_contents($path);
    //  $header = file_get_contents($path);

     if (isset($header)) {
      return $path;
  }
}catch(\Exception $e){
  return asset('images/no_products_found.jpg');
    }//endtry catch


  //  return $path->urlimagen;
}
    //return $path && file_exists($path) ? asset($path) : asset('images/no_products_found.jpg');
}

function imagePromo($path)
{
  if( empty($path) ){
    return asset('images/no_products_found.jpg');
}else{


    return $path;
}
    //return $path && file_exists($path) ? asset($path) : asset('images/no_products_found.jpg');
}



function imageVerify($path)
{
  //tratare de hacer una funcion que verifique si existe en la base de datos pero que ademas verifique si existe en el directoio
  //solo en caso sespecificos logo y esas cosas no quiero hacerlo en productos por la lentitiud

  if( empty($path) ){
    return asset('images/350x65.png');
}else{
    try{
     $header =  url_get_contents($path);
     // $header = file_get_contents($path);
     if (isset($header)) {
      return $path;
  }
}catch(\Exception $e){
  return asset('images/350x65.png');
}
}
}




/*

function image($path)
{
    return $path && file_exists($path) ? asset($path) : asset('images/no_products_found.jpg');
}
*/












function unitario($id){

//paso 1 obetner el id de la vista y luego obtener el id del producto relacionado
  $producto_id = DB::table('productos')
  ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
  ->where('imgproductos.id', $id)
  ->select('imgproductos.id_producto')
  ->value('imgproductos.id_producto');

  $producto = DB::table('productos')
  ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
  ->where('imgproductos.id', $id)
  ->get();

//paso 2. seleccionar el precio total de la base de datos.
  $precioventa_iva = DB::table('productos')
  ->where('id', $producto_id)
  ->select('precioventa_iva')
  ->value('precioventa_iva');
//paso 3.

  $promocion = DB::table('productos')
  ->where('id', $producto_id)
  ->select('promocion')
  ->value('promocion');

  $now = Carbon::now()->format('Y-m-d');


  $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->value('valor_trm');

  $moneda= DB::table('productos')
  ->join ('monedas', 'monedas.id', '=', 'productos.id_moneda')
  ->where('productos.id', $producto_id)
  ->select('monedas.id')
  ->value('monedas.id');

  $trm=null;

  if ($moneda == 1){
    $precioventa_iva = $precioventa_iva*$trmdeldia;
}



if ($promocion == '1'){

 $fechapromocion_inicial = DB::table('productos')
 ->where('id', $producto_id)
 ->select('fechapromocion_inicial')
 ->value('fechapromocion_inicial');

 $fechapromocion_final = DB::table('productos')
 ->where('id', $producto_id)
 ->select('fechapromocion_final')
 ->value('fechapromocion_final');

 $id_tipodepromocion = DB::table('productos')
 ->where('id', $producto_id)
 ->select('id_tipodepromocion')
 ->value('id_tipodepromocion');




 if (  $fechapromocion_inicial <= $now &&  $fechapromocion_final   >= $now ) {
//si el tipo de promocion 1 es porcentaje sino es dinero

   $valor_promocion = DB::table('productos')
   ->where('id', $producto_id)
   ->select('valor_promocion')
   ->value('valor_promocion');

   if ($id_tipodepromocion == '1'){
      $descuento  = (($precioventa_iva * $valor_promocion) / 100);
      $total=  $precioventa_iva-$descuento;
      return $total;

  }else{

      $total  = $precioventa_iva - $valor_promocion;
      return $total;
    }//endelse
                  $valorbruto = ($precioventa_iva * $trm); // Valor tachado en la plantilla
                  $valorneto  = ($valorbruto - $descuento); // valor no tachado en negrita
              }else{
               return $precioventa_iva;
 } //endif fecha promocion

}else{

              } //si el producto no esta en promocion se muestra el precio normal

              return $precioventa_iva;
          }



          function verificar_si_producto_carrito_existe(){

              foreach (Cart::instance('default')->content() as $product) {

                $producto = DB::table('productos')
                ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
                ->where('imgproductos.id', $product->id)->get();

                $id_provedor= $product->options->id_provedor;

                $referencia= $product->options->referencia;

                $busqueda=DB::table('productos')
                ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
                ->where('productos.id_provedor', $id_provedor)
                ->where('productos.referencia', $referencia)
                ->get();


                if (!$busqueda->isEmpty() ) {
                   update_price();

               }else{
                toast('Estimado usuario. Algunos productos no se encuentran en existencia y fueron eliminados.','info','top-right');
                Cart::instance('default')->remove($product->rowId);
            }

        }

    }


    function update_price(){

        foreach (Cart::content() as $product) {

          $precioventa_iva = DB::table('productos')
          ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
          ->where('imgproductos.id', $product->id)->select('precioventa_iva')->value('precioventa_iva');

          Cart::update($product->rowId, [
            'price' => $precioventa_iva,
        ]);

      }
  }


  function verificar_si_producto_favoritos_existe(){

    foreach (Cart::instance('favoritos')->content() as $product) {

      $producto = DB::table('productos')
      ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
      ->where('imgproductos.id', $product->id)->get();

      $id_provedor= $product->options->id_provedor;
      $referencia= $product->options->referencia;

      $busqueda=DB::table('productos')
      ->join('imgproductos', 'productos.id', 'imgproductos.id_producto')
      ->where('productos.id_provedor', $id_provedor)
      ->where('productos.referencia', $referencia)
      ->get();


      if (!$busqueda->isEmpty() ) {

         update_price();

     }else{
      toast('Estimado usuario. Algunos productos no se encuentran en existencia y fueron eliminados.','info','top-right');
      Cart::instance('favoritos')->remove($product->rowId);
  }


}
}


function setActiveCategory($categoria, $output = 'active')
{
  return request()->categoria == $categoria ? $output : '';
}

function getTrm($producto)
{
  return request()->producto == $categoria ? $output : '';
}



function renderNode($node) {

  $html = '<ul>';

  if( $node->isLeaf() ) {
    $html .= "<li>". "<a href='{{url('test')}}'> " . $node->name ."</a>" ."</li>";
} else {
    $html .= "<li>". $node->name;

    $html .= "<ul>";

    foreach($node->children as $child)
      $html .= renderNode($child);

  $html .= "</ul>";

  $html .="</li>";
}

$html .= "</ul>";

return $html;
}













function precioNew($slug) {

  $producto=Productomodelo::
  with('hasManyPromociones')->
  where('slug', $slug)->first();

  if (!$producto) {
    return 0;
}

$now = Carbon::now()->format('Y-m-d');
$trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->value('valor_trm');
$trm=null;




          //$utilidad= $producto->porcentaje_utilidad/100 * $producto->preciocosto_iva;
$utilidad= $producto->porcentaje_utilidad/100 * $producto->preciocosto;

if( $producto->iva ==0){
    $iva=1;
}else{
    $iva=$producto->iva/100+1;
}


$precio_costo=  (float)$producto->preciocosto;
$precio_costo_iva= $precio_costo*$iva;
$precio_costo_utilidad=$producto->preciocosto+$utilidad;
$precio= $precio_costo_utilidad * $iva ;



if ($producto->id_moneda == 1){
    $precio = round ($precio*$trmdeldia);
}else{
    $precio=round($precio);
}


if (count($producto->hasManyPromociones) ) {

    if (
      ($producto->hasManyPromociones->first()->date_start <= $now  &&  $producto->hasManyPromociones->first()->date_end >= $now)

      &&
      ($producto->hasManyPromociones->first()->hour_start <= date("h:i:s")
        &&
        $producto->hasManyPromociones->first()->hour_end >= date("h:i:s"))
  ) {

       if ($producto->hasManyPromociones->first()->tipo_promocion == 1){
          $descuento  = (($precio * $producto->hasManyPromociones->first()->valor) / 100);
          $total=  $precio-$descuento;

          return round($total);
      }else{

          $total  = $precio - $producto->hasManyPromociones->first()->valor;

          return round($total);
    }//endelse

                  $valorbruto = ($precio * $trm); // Valor tachado en la plantilla
                  $valorneto  = ($valorbruto - $descuento); // valor no tachado en negrita
              }else{

                  if ($producto->id_tipodepromocion == '1'){
                    $descuento  = (($precio * $producto->valor_promocion) / 100);
                    $total=  $precio-$descuento;

                    return round($total);


                }else{

                    $total  = $precio - $producto->valor_promocion;
                    return round($total);
    }//endelse


 } //endif fecha promocion


}else{

  if ($producto->promocion == 1){

    if (  $producto->fechapromocion_inicial <= $now &&  $producto->fechapromocion_final   >= $now ) {

      if ($producto->id_tipodepromocion == 1){


        $descuento  = (($precio * $producto->valor_promocion) / 100);
        $total=  $precio-$descuento;
        return round($total);

    }else{

        $total  = $precio - $producto->valor_promocion;
        return round($total);
    }//endelse
                  $valorbruto = ($precio * $trm); // Valor tachado en la plantilla
                  $valorneto  = ($valorbruto - $descuento); // valor no tachado en negrita
              }else{

                  if ($producto->id_tipodepromocion == '1'){
                    $descuento  = (($precio * $producto->valor_promocion) / 100);
                    $total=  $precio-$descuento;
                    return round($total);

                }else{

                    $total  = $precio - $producto->valor_promocion;
                    return round($total);
    }//endelse


 } //endif fecha promocion

}//si el producto no esta en promocion se muestra el precio normal
}//else hasmanyprmociones



return round($precio);

}




function old_price($slug){


  $producto=Productomodelo::where('slug', $slug)->first();
  if (!$producto) {
    return 0;
}

$now = Carbon::now()->format('Y-m-d');
$trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->value('valor_trm');


$trm=null;


$utilidad= $producto->porcentaje_utilidad/100 * $producto->preciocosto_iva;
if( $producto->iva ==0){
    $iva=1;
}else{
    $iva=$producto->iva/100+1;
}


$precio_costo=  (float)$producto->preciocosto;
$precio_costo_iva= $precio_costo*$iva;
$precio_costo_utilidad=$producto->preciocosto+$utilidad;
$precio= $precio_costo_utilidad * $iva ;


if ($producto->id_moneda == 1){
    $precio = round ($precio*$trmdeldia);
}else{
    $precio=round($precio);
}


if (count($producto->hasManyPromociones) ) {

    if (
      ($producto->hasManyPromociones->first()->date_start <= $now  &&  $producto->hasManyPromociones->first()->date_end >= $now)
      &&
      ($producto->hasManyPromociones->first()->hour_start <= date("h:i:s")
        &&
        $producto->hasManyPromociones->first()->hour_end >= date("h:i:s"))

  ) {

       if ($producto->hasManyPromociones->first()->tipo_promocion == 1){
          $total  = $precio;
          return round($total);
      }else{

          $total  = $precio;

          return round($total);
    }//endelse

}else{
    return $precio.'promocion terminada';
 } //endif fecha promocion


}else{

  if ($producto->promocion == 1){


    if ( $producto->fechapromocion_inicial <= $now &&  $producto->fechapromocion_final   >= $now ) {
//si el tipo de promocion 1 es porcentaje sino es dinero



      if ($producto->id_tipodepromocion == 1){
        $descuento  = (($precio * $producto->valor_promocion) / 100);
        $total=  $precio-$descuento;
        return $precio;

    }else{

        $total  = $precio - $producto->valor_promocion;
        return $precio;
    }//endelse

}else{
 return $precio;
 } //endif fecha promocion

}

} //si el producto no esta en promocion se muestra el precio normal

return $precio;
}



















//saferbo helper









?>
