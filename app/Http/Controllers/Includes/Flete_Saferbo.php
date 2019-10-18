<?php  
	
namespace App\Http\Controllers\Includes;	

use Illuminate\Http\Request;
use App\Transportadores;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\ShoppingCart;
use App\Estados;
use App\Ciudades;
use App\Proveedores_Trans;
use App\Productomodelo;
use App\User;
use Carbon\Carbon as Carbon;

 class Flete_Saferbo{

 	public function flete($request,$id){
        $now = Carbon::now()->format('Y-m-d');
        $trmdeldia =DB:: table('trm')->select('valor_trm')->where('fecha' , $now)->orderBy('id', 'DESC')->value('valor_trm');

        $id_departamento= $request->state;
        $id_ciudad=$request->city;

        $dep_code=Estados::where('id' , $id_departamento)->value('code');
        $city_code=Ciudades::where('id' , $id_ciudad)->value('code');
        $code= $dep_code.$city_code.'000';

        $dep_name=Estados::where('id' , $id_departamento)->value('region');
        $city_name=Ciudades::where('id' , $id_ciudad)->value('city');

        $ciu = $this->remove($city_name);
        $dep = $this->remove($dep_name);

        $cadena= $dep.'-'.$ciu.'-'.$code;


        //$saf = Transportadores::first();
        $saf = Transportadores::where("id", $id)->first();

        $total=0;
        $total_peso=0;
        $ids=[];
        $valor_flete=[];
        $applied=0;
        $product_valor_flete=0;
        $totalizacion=0;
        $peso_volumen=0;
        $valor_flete_tipo_porcentaje=0;
        $valor_flete_tipo_descuento=0;
        $total_proveedores_trans=0;
        $total_productos=0;
        $total_iva=0;
        $total_saferbo=0;
        $total_vr_declarado=0;
        $total_unidades=0;

        foreach (Cart::instance('default')->content() as $i => $producto){

            $product = Productomodelo::where('slug' , $producto->id)->first(); 

            $total_productos = $total_productos + precioNew($product->slug) ;
            //$total_iva= $total_iva + totaliva($product->slug) ;  //Esto no se usa y fuera de eso no multiplica por la TRM como la función (precioNew())

            $pesovolumen = ($product->largo * $product->ancho * $product->alto) / $saf->factor;

            if ($product->peso > $pesovolumen ) {
                $pesovolumen= $product->peso;
            }else{
                $pesovolumen=$pesovolumen;
            }

            $total_peso   = $total_peso   + ($product->peso * $producto->qty);
            $peso_volumen = $peso_volumen + ($pesovolumen   * $producto->qty);

            ### si id_moneda = 2  --> Es pesos colombianos ###
            if ($product->id_moneda == 2){
                $total_vr_declarado = $total_vr_declarado + ($product->valordeclarado  * $producto->qty);
            }else{
                $total_vr_declarado = $total_vr_declarado + (($product->valordeclarado * $trmdeldia) * $producto->qty);
            }

            $total_unidades = $total_unidades + $producto->qty;


            ### Esto era para PROVEEDORES_TRANS pero ya no sirve para nada ###
            /*
            if ($product->valor_flete ) {
                $product_valor_flete=$product_valor_flete+ floatval($product->valor_flete);
            }

            //TABLA PROVEEDORES TRANS //1. verificamos si id del proveedor del producto es igual  a proveedores trans.  //2. este precio sera prioritario del siguiente que calcula saferbo en este caso (else)
            $proveedores_trans =  Proveedores_Trans::where('id_proveedor', $product->id_provedor)->first();

            if ($proveedores_trans) {
                //si la ciudad es igual calcular
                if ($proveedores_trans->id_ciudad ==$id_ciudad) {

                    if ($proveedores_trans->tipo== 1){
                    //si el tipo de flete es procentaje se le aplicara el porcentaje al precio del producto con la funcion de precios incluida
                    $valor_flete_tipo_porcentaje  = ( precioNew($product->slug) * $proveedores_trans->flete  / 100);

                    //esta variable valor flete es un array que al final del foreach determina cual es el producto en el carrito con mayor precio para agregar ese precio al total de flete es decir, si un producto del proveedor x tiene un porcentaje del 10, este valor deberia sumarse, pero solo sumarse una vez, y esa unica vez sera el mayor de todos lo que tengan ese valor aplicado en proveedores_trans.
                    }else{
                    //el valor de proveedores trans solo se contatenara si el proveedor es distinto. No se concatenara el valor proveedor si este valor ya fue aregado al precio final si un producto de nexys en proveedores trans el flete vale 1000 y existe otro producto del mismo proveedor se deberia ignorar debido a que el flete valdria lo mismo por proveedor. solo se ignora no se va a sumar el flete por segunda vez 
                        if (!in_array( $proveedores_trans->id_proveedor, $ids)  ) {
                            $ids[]= $proveedores_trans->id_proveedor;
                            $valor_flete_tipo_descuento=(float) $proveedores_trans->flete;
                        }
                    } //tipo de descuento
                }
            }
            */

         }//end foreach


        ### Esto era para PROVEEDORES_TRANS pero ya no sirve para nada ###
        /*         
        $total_proveedores_trans= $valor_flete_tipo_porcentaje+ $valor_flete_tipo_descuento;
        if (!$total_proveedores_trans ==0) {
            $totales[]=$total_proveedores_trans;
        }
        */



        if (!$product_valor_flete == 0) {
            $totales[]=$product_valor_flete;
        }

        //si total es igual a ero verifica que el producto tenga las medidas ancho largo alto
        //se retorna el total de proveedores trans
        if (! $peso_volumen == 0) {

            $idciudadespacho=$saf->cadena;
            $idciudadestino=$cadena;
            //$dsunidad=1; //Creo toca sumar las unidades
            $dsunidad=$total_unidades;

            $dskilos=floatval($total_peso);
            //$dsvalordec=$product->valordeclarado;
            $dsvalordec=round($total_vr_declarado);
            
            // estas variables son fijas
            $idtarifaxtrayecto=2;
            $ds_largo=null;
            $ds_ancho=null;
            $ds_alto= null;
            $ds_pesovol=floatval($peso_volumen);
            $ds_contraentrega=0;
            $tipoacceso=1;
            $tipodatos=2;
            
            //$codigo=$saf->code; // ESTE YA NO LO USO 
            $codigo=$saf->codigo;
            //tipo de negociacion 1=credito
            $idnegociacion=$saf->negociacion;//
            //tipo de envio 3=mensjeria   1=paqueteo
            $idtipoenvio=1; // Valor Fijo
            $idtipoliquidacion=$saf->liquidacion; //Valor fijo
            $url="https://app.saferbo.com/webservices/ws.generar.guias.php";
            // estas variables se validan  en caso de estar vacias
            if ($idtipoliquidacion=="") $idtipoliquidacion=1;
            $destino="destino=$idciudadestino&origen=$idciudadespacho&ds_peso=$dskilos&ds_valoracion=$dsvalordec";
            $destino.="&ds_largo=$ds_largo&ds_ancho=$ds_ancho&ds_alto=$ds_alto&ds_pesovol=$ds_pesovol";
            $destino.="&ds_contraentrega=$ds_contraentrega&tipoacceso=$tipoacceso&tipodatos=$tipodatos&ds_cantidad=$dsunidad";
            $destino.="&dscodigocliente=$codigo&idnegociacion=$idnegociacion&idtipoenvio=$idtipoenvio&idtipoliquidacion=$idtipoliquidacion";
            $destino.="&idtarifaxtrayecto=$idtarifaxtrayecto";
            // INICIACION METODO CURL
            $c = curl_init($url);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($c, CURLOPT_POST, true);
            curl_setopt($c, CURLOPT_POSTFIELDS, $destino);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            $var = curl_exec($c); 

            if (curl_error($c)) {
                $error_msg = curl_error($c);
            }
            $array = explode('|', $var);
            $total_saferbo=(float)$array[3];
            //return response()->json($array[3]);
            if (!$total_saferbo ==0) {
                $totales[]=$total_saferbo;
            }

        } // END IF

        $flete =  min($totales);





        /*
        if (!$total_proveedores_trans == 0 && !empty($total_proveedores_trans) ){
          $total=$total+(float)$total_proveedores_trans;
        }

        //si algun producto tiene algun costo de envio den producto->valor_flete se suma al valor total
        if (!$product_valor_flete == 0 && !empty($product_valor_flete) ){
          $total=$total+(float)$product_valor_flete;
        }
        */

        return round($flete);
        //return response()->json(  round($flete) );

 	}



    public function remove($string)
    {

        $title = $string;
        $search = explode(",","ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u");
        $replace = explode(",","c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u");
        $cadena= str_replace($search, $replace, $title);
        $cadena = strtoupper($cadena);
        return $cadena;
    }


 }

?>