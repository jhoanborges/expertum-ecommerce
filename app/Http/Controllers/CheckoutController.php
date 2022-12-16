<?php

namespace App\Http\Controllers;

use DB;
use App\Parametromodelo;
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
use App\Traits\CrediBancoTrait;
use App\Traits\FacturasTrait;
use Illuminate\Support\Facades\Redirect;

use App\Http\Controllers\TransportadoresController;

//esta funcion imagino la hizo el ing neida la copiare para reutilizarla
use App\Http\Controllers\Includes\Flete_Saferbo;


class CheckoutController extends Controller
{
	use CrediBancoTrait;
	use FacturasTrait;

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

			toast('El carrito de compras está vacío','warning','top-right');
			return redirect()->route('resumen');
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


		$depfacturacion = DB::table('region')->select('region')
		->where('id', '=', Auth::user()->id_region)
		->first();

		$ciufacturacion = DB::table('city')->select('city')
		->where('id', '=', Auth::user()->id_city)
		->first();


		$transportistas = Transportadores::all();
		$parametros = Parametromodelo::first();

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
				'dirfacturacion' => Auth::user()->direccion,
				'telfacturacion' => Auth::user()->telefono,
				'depfacturacion' => $depfacturacion->region ?? null,
				'ciufacturacion' => $ciufacturacion->city ?? null,
				'transportistas' => $transportistas,
				'parametros' => $parametros,
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
				'transportistas' => $transportistas,
				'parametros' => $parametros,

			]);
		}



	}











	public function store(Request $request){
		if ( Cart::content()->count() <= 0 ) {
			toast('El carrito de compras está vacío','warning','top-right');
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

			//como el "cargo" no es un valor required en  el frontend
			//como adicional añado una validacion en el backend

			if( !$request->has('cargos') || $request->cargos == '' || $request->cargos == null){
				toast('Debes seleccionar un método de envío','warning','top-right');
				return redirect()->back()->withInput();
			}

			//esta variable tomara todos los precios de los productos

					//cargo de cliente sinose selecciona el cargo
		$cargo  = $request->cargos ?? 'cargo_cliente';
		$total_saferbo=0;
	

        if($cargo === 'cargo_cliente'){
			//si es cargo al cliente, no se calcula el valor del flete
			$observaciones = 'El comprado ha seleccionado Envío a cargo del cliente. Transportista: ';
					

			$transportista = Transportadores::
			where('nombretrasportador', 'like', '%'. $request->transportista.'%')->first();

			if($transportista){
				///el nombre se parece al transportista
				$observaciones = $observaciones . ' '.$transportista->nombretrasportador;
			}else{
				$observaciones = $observaciones . ' '.$request->transportista;
			}
			
			$observaciones = $observaciones .'. Observaciones: ' . $request->observaciones;

            
        }else if($cargo === 'recoger_tienda'){
            //flete igual a cero
			$observaciones = 'El comprado ha seleccionado Recoger en tienda. Observaciones: ' . $request->observaciones;

        }else if($cargo === 'cargo_tienda'){
			//si es cargo a tienda, se calcula el valor del flete, esta es la primera opcion

			$servicio = new Flete_Saferbo();
			$total_saferbo = $servicio->flete($request,$trans->id);
		
			if($total_saferbo == 'error'){
				toast('No se ha podido conectar con el servidor de envíos, por favor, intente nuevamente','warning','top-right');
			return redirect()->back()->withInput();
			}

			$observaciones = 'El comprado ha seleccionado Envío a cargo de la tienda. Observaciones: ' . $request->observaciones;

        }else{
			toast('Debe seleccionar un método de envío','warning','top-right');
			return redirect()->back();
        }

			/*
			if( ($total_saferbo <= 0) || ($total_saferbo == null) ){
				toast('Error al obtener el valor del flete. Contacte al administrador.','error','top-right');
				return redirect()->back();
			}
			*/

			//creacion de la factura y detalle de factura
			$transaction_bill_details = $this->createFacturaYDetalle($request, $total_saferbo, $observaciones);

			$nombres = $transaction_bill_details['nombres'];
			$base_iva = $transaction_bill_details['base_iva'];
			$subtotal = $transaction_bill_details['subtotal'];
			$total_iva = $transaction_bill_details['total_iva'];
			$factura = $transaction_bill_details['factura'];

			$totalizacion = $subtotal + $total_saferbo;

			$newname= $this->getModifiedNameAttribute($nombres);
			$moneda= Monedas::where('monedalocal', 1)->first();
			$moneda_name=strtoupper($moneda->name);

			$pasarela = Pasarelas::where('predeterminado', true)->first();
			//$mercadopago= MercadoPago::where('predeterminado', true)->first();
			//$epayco= ePayco::where('predeterminado', true)->first();

			$apiKey = null;
			$merchantId = null;
			$accountId = null;
			$signature = null;
			$firma = null;
			$preference=null;


			$pasarelaPago=$pasarela->type;

			if($pasarelaPago == 'payu'){

				$apiKey =  $pasarela->apikey;
				$merchantId = $pasarela->merchantid;
				$accountId = $pasarela->accountid;
				$endpoint_url ="https://checkout.payulatam.com/ppp-web-gateway-payu/";
				
				if(env('APP_ENV') == 'local'){
				//TEST PAYU
					$merchantId = "508029";
					$apiKey =  "4Vj8eK4rloUd272L48hsrarnUA";
					$accountId = "512321";
					$endpoint_url ="https://sandbox.checkout.payulatam.com/ppp-web-gateway-payu/";
					//END TEST PAYU
				}

				$signature = $apiKey . "~" . $merchantId . "~" . $factura->id . "~" . $totalizacion . "~" . $moneda_name;
				$firma = md5($signature);

				return view('layouts.checkout_landing')->with([
					'endpoint_url'=>$endpoint_url,
					'type'=>$pasarelaPago,
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
					'test'=> env('APP_ENV') == 'local'  ? 1 : 0 ,
					'return_url'=>$pasarela->endpoint,
					'callback_url'=>$pasarela->return_url,
					]);


			}else if($pasarelaPago == 'credibanco'){	
				$transaction = $this->createOrderCrediBanco($totalizacion, $factura->id);
				return Redirect::to($transaction['formUrl']);

			}else  if($pasarelaPago == 'epayco'){

				$products_names = '';
				foreach (Cart::content() as $product) {
					$products_names = $products_names . ' '. $product->name;
				}

				return view('layouts.checkout_landing')->with([
					'type'=>$pasarelaPago,
					'products_names'=>$products_names,
					'key'=>$pasarela->apikey,
					'response'=>$pasarela->response,
					'test'=> env('APP_ENV') == 'local'  ? 'true' : 'false' , //$pasarela->modo_prueba,
					'confirmation'=>$pasarela->confirmation,
					'p_key'=>$pasarela->username, //p_key as username in database
					'client_id'=>$pasarela->client_id,
					'private_key'=>$pasarela->password, //private_key as password in database
					'request' => $request->all(),
					'base_iva' => $base_iva,
					'iva'=> $total_iva,
					'moneda_name'=>$moneda_name,
					'totalizacion'=> $totalizacion,
					'reference' => $factura->id,
				]);


			}else  if($pasarela->type == 'mercadopago'){

				$mp = new MP ($pasarela->client_id, $pasarela->client_secret);
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

					return view('layouts.checkout_landing')->with([
						'type'=>$pasarelaPago,
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
						'request' => $request->all(),
					]);

			}else{
				toast('No hay métodos de pago disponible. Contacta al administrador','error','top-right');
				return redirect()->back();
			}

	
			$factura_update = Factura::where('id', $factura->id)->update([
				'id_transportador' => $trans->id,
				'flete' => $total_saferbo,
				'total_productos' => $subtotal,
				'total' => $totalizacion,
			]);


		}

					//destruir el carrito de compras
		if(env('APP_ENV') != 'local'){
			Cart::destroy();
			Cart::instance('default')->destroy();
			ShoppingCart::deleteCartRecord(Auth::id(), 'default');
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

	public function getCart()
	{
		$data = Cart::instance('default')->content()->toArray();
		$objects = [];
		foreach($data as $cart){
	
			$objects [] = $cart;
		}
		return response()->json($objects);
	}


		public function removeProductFromCart(Request $request)
	{
		Cart::remove($request->id);

		if (Auth::check()) {
		 $id_2 = Auth::id();
		 ShoppingCart::deleteCartRecord($id_2, 'default');
		 Cart::store($id_2);
	   }

		return response()->json(true , 200);
	}


			public function getCheckoutSettingsForStore(Request $request){
		 $data = Parametromodelo::first();

		return response()->json( $data , 200);
	}




	


}
