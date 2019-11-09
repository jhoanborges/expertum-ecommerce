<?php

namespace App\Http\Controllers;

use DB;
use App\Clientemodelo;
use App\Facturamodelo;
use App\Detallefacturamodelo;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Database\Eloquent\Model;
use App\ShoppingCart;
use Auth;
use App\Categorian1modelo;
use Excel;
use Storage;
use App\Saferbo;
use App\Pasarelas;
use App\Direcciones;
use App\Monedas;
use App\Estados;
use App\User;
use App\Transportadores;
use App\Productomodelo;
use App\MercadoPago;
use MP;
use App\ePayco;
use App\OrdenPago;
use Session;
use App\Proveedores_Trans;
use App\Ciudades;
use Illuminate\Support\Str;
use App\Identificacion;
use App\Factura;
use App\DetalleFactura;

use App\Http\Controllers\TransportadoresController;

//esta funcion imagino la hizo el ing neida la copiare para reutilizarla
use App\Http\Controllers\Includes\Flete_Saferbo;


class CheckoutController extends Controller
{

	public function getModifiedNameAttribute($value)
	{
		$skips = ['"','[',']','\','];
		return strtoupper(str_replace($skips,' ',$value) );
	}


	private function storeCart()
	{
		if(Auth::check())
		{
			$user_id = Auth::id();
			ShoppingCart::deleteCartRecord($user_id, 'default');
			Cart::store($user_id);
		}
	}






	public function index(){

		if (Cart::content()->count() <= 0 ) {
			toast('El carrito de compras esta vacío','warning','top-right');
			return redirect()->back();
		}else{

			$this->storeCart();

			$cont=0;
			$sub=0;

			foreach (Cart::content() as $i => $product){
				$valor_producto=precioNew($product->id)*$product->qty;
				$sub =$sub+ ($valor_producto  /  ($product->options->iva/100 +1) );
				$precio_unitario=($valor_producto  /  ($product->options->iva/100 +1));
				$cont= $cont + ($valor_producto -$precio_unitario );
			}


			$identificacion = Identificacion::query();
			$identificacion->when(Auth::user()->tipo == 2, function ($q) {
				return $q->where('id', 2)->get();
			});
			$identificacion->when(Auth::user()->tipo != 2, function ($q) {
				return  $q->where('id','!=', 2)->get();
			});
			$identificacion= $identificacion->get();

			$defaultcountry= DB::table("country")->select('country')->where('id', 53)->get() ;

			$total=$cont+$sub;

			$pasarela = Pasarelas::where('predeterminado', true)->first();
			$mercadopago= MercadoPago::where('predeterminado', true)->first();


			if ($pasarela) {
				$button=1;
			}else if($mercadopago){
				$button=2;
			}else{
				$button=0;
			}
		}

		$categorias=Categorian1modelo::all();
		$cat2=1;

		$direcciones = Direcciones::where('user_id' ,  Auth::id() )
		->leftjoin('country', 'direcciones.id_pais', '=', 'country.id')
		->leftjoin('region', 'direcciones.id_departamento', '=', 'region.id')
		->leftjoin('city', 'direcciones.id_ciudad', '=', 'city.id')
		->leftjoin('tipoidentificacion', 'direcciones.tipo_identificacion', '=', 'tipoidentificacion.id')
		->select('direcciones.*',
			'country.country as pais',
			'region.region as departamento',
			'city.city as ciudad',
			'tipoidentificacion.nombre as tipoidentificacion'
		)
		->get();


		if (Auth::user()->tipo==1) {
			return view('layouts.checkout')->with([
				'totaliva' => $cont,
				'total' => $total,
				'sub' => $sub,
				'defaultcountry' => $defaultcountry,
				'identificacion' => $identificacion,
				'cat2' => $cat2,
				'categorias' => $categorias,
				'direcciones' => $direcciones,
				'button' => $button,
			]);

		}else{
		//empresas
			return view('layouts.checkout_empresas')->with([
				'totaliva' => $cont,
				'total' => $total,
				'sub' => $sub,
				'defaultcountry' => $defaultcountry,
				'identificacion' => $identificacion,
				'cat2' => $cat2,
				'categorias' => $categorias,
				'direcciones' => $direcciones,
				'button' => $button,
			]);
		}



	}











	public function store(Request $request){

		if (Cart::content()->count() <= 0 ) {
			toast('El carrito de compras esta vacío','warning','top-right');
			return redirect()->back();
		}else{


			//dd($request->email . " " . $request->flete . "===");

			### si quiero verificar nuevamnete flete ejecuto estas dos lineas ###
			//$servicio = new TransportadoresController();
			//dd($servicio->flete_value($request));
			#####################################################################


			//$reference= (string) Str::uuid();

			##############################################################
			# TRANSPORATDOR PREDETERMINADO
			# ESTE ES EL MISMO transportadoresController->(flete_value)
			##############################################################
			$trans = Transportadores::where("estado", 1)->first();
			##############################################################


			$totalizacion=0;
			$total_peso=0;
			$ids=[];
			$applied=0;
			//valores del flete
			$product_valor_flete=0;
			$peso_volumen=0;
			$valor_flete_tipo_porcentaje=0;
			$valor_flete_tipo_descuento=0;
			$total_proveedores_trans=0;

			//esta variable tomara todos los precios de los productos
			$subtotal=0;
			$nombres='';
			$total_iva=0;
			$base_iva = 0;

///aca cvolver a conectar con saferbo y calcular ciudad y estado
///
			//$total_saferbo=0;
			//$total_saferbo = $request->flete;
            //
			//$total_saferbo = $request->vlrflete;

            $servicio = new Flete_Saferbo();
            $total_saferbo = $servicio->flete($request,$trans->id);


			//creacion de factura y detalle factura
            $factura = Factura::create([
                'name' => $request->entregar,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'tipo_identificacion' => isset(  $request->tipo_identificacion  ) ? $request->tipo_identificacion : 2,
                'numeroidentificacion' => $request->numero,
                'direccion' => $request->direccion,
                'observacion' => $request->observaciones,
                'id_ciudad' =>$request->city,
            ]);


            foreach (Cart::instance('default')->content() as $i => $producto){

                $product = Productomodelo::where('slug' , $producto->id)->first();
				//$extra1[]= $product->id;
                $nombres = $nombres.$product->nombre_producto;

				//$total_productos = $total_productos + precioNew($product->slug) ;
				//$total_iva       = $total_iva + totaliva($product->slug) ;

                $valor_producto = precioNew($product->slug)*$producto->qty;
                $precio_base    = round(($valor_producto  /  ($producto->options->iva/100 +1)), 2);
                if ($producto->options->iva != 0){
                   $base_iva = $base_iva + $precio_base;
               }
               $subtotal       = $subtotal + $valor_producto ;
               $total_iva      = round($total_iva + ($valor_producto - $precio_base ), 2);
				//$total_iva    = $total_iva + totaliva($product->slug) ;

               $detalle_factura = DetalleFactura::create([
                   'id_factura' =>$factura->id,
                   'id_producto' =>$product->id,
                   'id_provedor' => $product->id_provedor,
                   'referencia' => $product->referencia,
                   'name' => $product->nombre_producto,
                   'descuento' => isset(    $product->hasManyPromociones->first()->tipo_promocion  ) ?  $product->hasManyPromociones->first()->tipo_promocion : null,
                   'valor' =>isset(    $product->hasManyPromociones->first()->valor  ) ?  $product->hasManyPromociones->first()->valor : null,
                   'iva' =>$product->iva,
                   'total' =>precioNew($product->slug),
                   'cantidad' =>$producto->qty,
               ]);

			}//end foreach

			$totalizacion = $subtotal + $total_saferbo;

			$newname= $this->getModifiedNameAttribute($nombres);
			$moneda= Monedas::where('monedalocal', 1)->first();
			$moneda_name=strtoupper($moneda->name);

			$pasarela = Pasarelas::where('predeterminado', true)->first();
			$mercadopago= MercadoPago::where('predeterminado', true)->first();
			$epayco= ePayco::where('predeterminado', true)->first();


			//aca agregar un switch case
			if ($pasarela) {
				$pasarelaPago=1;
			}else if($mercadopago){
				$pasarelaPago=2;
			}else if ($epayco) {
				$pasarelaPago=3;
			}



			$apiKey = null;
			$merchantId = null;
			$accountId = null;
			$signature = null;
			$firma = null;
			$preference=null;


			//Cart::destroy();
			//ShoppingCart::deleteCartRecord(Auth::id(), 'default');
			//Cart::store(Auth::id())

			$factura_update = Factura::where('id', $factura->id)->update([
				'id_transportador' => $trans->id,
				'flete' => $total_saferbo,
				'total_productos' => $subtotal,
				'total' => $totalizacion,
			]);


			switch ($pasarelaPago) {

				case 1:

             if ($pasarela) {
              $apiKey =  $pasarela->apikey;
              $merchantId = $pasarela->merchantid;
              $accountId = $pasarela->accountid;

                  //test payu
              $merchantId = "508029";
              $apiKey =  "4Vj8eK4rloUd272L48hsrarnUA";
              $accountId = "512321";


              $signature = $apiKey . "~" . $merchantId . "~" . $factura->id . "~" . $totalizacion . "~" . $moneda_name;
              $firma = md5($signature);

              return view('layouts.checkout_landing')->with([
               'firma' => $firma,
               'merchantId' => $merchantId,
               'accountId' => $accountId,
               'descripcionproducto' => $newname,
               'reference' => $factura->id,
               'base_iva' => $base_iva,
               'iva'=> $total_iva,
               'moneda_name'=>$moneda_name,
               'fullname'=> $request->entregar,
               'direccion'=> $request->direccion,
               'totalizacion'=> $totalizacion,
               'request' => $request->all(),
           ]);


          }

          break;

          case 2:

          if ($mercadopago) {
              $mp = new MP ($mercadopago->client_id, $mercadopago->client_secret);
              $url= 'http://'.$_SERVER['HTTP_HOST'].'/notifications_mp/';

              $preference_data = array (
               "items" => array (
                array (
							//"id"=> "item-ID-1234",
                 "title" => $newname,
                 "picture_url"=> $prodc->urlimagen,
							//"description"=> "Item description",
                 "quantity" => 1,
						"currency_id" => $moneda_name, // Available currencies at: https://api.mercadopago.com/currencies
						"unit_price" => intval($totalizacion)
					)
            ),

               "payer" => array (
                array (
                 "name"=> Auth::user()->name,
                 "surname"=> Auth::user()->apellidos,
                 "email"=> Auth::user()->email,
             )
            ),

               "back_urls" => array (
                "success"=> "https://www.expertum.co",
                "failure"=> "http://www.expertum.co",
                "pending"=> "http://www.expertum.co"
            ),

               "notification_url"=> "http://aministracion.expertum.com.co/admin/public/notifications_mp",
               "external_reference"=> $detallesfactura->id_factura,

           );
              $preference = $mp->create_preference($preference_data);



              return view('layouts.landing_checkout')->with([
               'firma' => $firma,
               'merchantId' => $merchantId,
               'accountId' => $accountId,
               'descripcionproducto' => $newname,
               'reference' => $factura->id,
               'iva'=> $total_iva,
               'moneda_name'=>$moneda_name,
               'fullname'=> $request->entregar,
               'direccion'=> $request->direccion,
               'totalizacion'=> $totalizacion,

               'pasarelaPago'=> $pasarelaPago,
               'preference' => $preference,
               'epayco' => $epayco,
               'request' => $request->all(),
           ]);



          }
          break;

          default:

          dd('no existe pasarela de pago predeterminada');
          return view('layouts.landing_checkout')->with([
              'firma' => $firma,
              'merchantId' => $merchantId,
              'accountId' => $accountId,
              'descripcionproducto' => $newname,
              'reference' => $factura->id,
              'iva'=> $total_iva,
              'moneda_name'=>$moneda_name,
              'fullname'=> $request->entregar,
              'direccion'=> $request->direccion,
              'totalizacion'=> $totalizacion,

              'pasarelaPago'=> $pasarelaPago,
              'preference' => $preference,
              'epayco' => $epayco,
              'request' => $request->all(),
          ]);

          break;
      }

  }
	}//endf function




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
