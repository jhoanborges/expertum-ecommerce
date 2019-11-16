<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Productomodelo;
use  Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;


use App\Transportadores;
use App\ShoppingCart;
use App\Estados;
use App\Ciudades;
use App\Proveedores_Trans;
use App\User;


class HelperController extends Controller
{
    public function precioNew($slug) {

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

}
