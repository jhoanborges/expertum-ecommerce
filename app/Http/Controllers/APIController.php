<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Ciudades;
use App\Estados;



use Gloudemans\Shoppingcart\Facades\Cart;
use Validator;
use Auth;
use App\ShoppingCart;
use App\Productomodelo;
use App\Categorian1modelo;
use Alert;








class APIController extends Controller
{
	public function index()
	{
		$countries = DB::table("country")->lists("name","id");
		return view('index',compact('countries'));
	}
	public function getStateList(Request $request)
	{
		$states = Estados::where("country_id",$request->country_id)
		->orderBy('region', 'ASC')
		->pluck("id","region");

		return response()->json($states);
//Response::json(array('region'=>$region, 'id'=>$id));
	}

	public function getStateList2(Request $request)
	{
		$id=DB::table('country')->where('code',$request->code)->value('id');

		$states = Estados::where("country_id",$id)
		->orderBy('region', 'ASC')
		->pluck("region","code");

		return response()->json($states);
//Response::json(array('region'=>$region, 'id'=>$id));
	}



	public function getCityList(Request $request)
	{
		$cities = Ciudades::where("region_id",$request->state_id)
		->orderBy('city', 'ASC')
		->pluck("id","city");

		return response()->json($cities);
	}


	public function getCityList2(Request $request)
	{

		$id=Estados::where('code',$request->code)->value('id');

		$data = Ciudades::where("region_id",$id)
		->pluck("city","code");
		return response()->json($data);
	}




	public function select_city(Request $request){

    $validator = Validator::make($request->all(), [
      'state' => 'required|integer',
      'city' => 'required|integer',
      'qty' => 'required|integer|min:1',
      'id' => 'required|string|max:191',
    ]);



    if ($validator->fails()) {
      return response()
      ->json([
        'success' => false,
        'message' => 'Han ocurrido errores en la creación del cliente',
        'errors' =>   $validator->messages()
      ],500);
    }


		Session::put('departamento', $request->state);
		Session::put('ciudad', $request->city);
	//	

		$cantidad = Productomodelo::
		where('slug', $request->id)->value('cantidad');
		$validator = Validator::make($request->all(), [
			'qty' => 'required|numeric|integer|between:1,'.$cantidad,
		]);

		if ($validator->fails()) {

			alert()->info('Estimado usuario', 'La cantidad supera el inventario existente.')
			->showCloseButton()
			->autoClose(20000);
			return redirect()->back();
		}

		$duplicates = Cart::search(function ($cartItem, $rowId) use ($request) {
			if ($cartItem->id == $request->id) {

				if ($request->qty <= $cartItem->qty){
					toast('Este producto ya existe en el carrito','info','top-right')
					->showConfirmButton()
					->autoClose(20000);

        			// return redirect()->back()->with('test', 'test');
				}

				if ($request->qty > $cartItem->qty){

             Cart::update($rowId, $request->qty); // Will update the quantity
             //toast('Cantidad actualizada','success','top-right');
            // return redirect()->route('resumen');
         }
     }
 });

		if ($duplicates->isEmpty()) {

			$producto= Productomodelo::with('hasManyImagenes')->
			where('slug',$request->id)->first();

			$cartItem = Cart::add($producto->slug ,$producto->nombre_producto , $request->qty , 
				$producto->precioventa_iva ,
				0, [
				'iva' => $producto->iva,
				'imagen' =>  $producto->hasManyImagenes->first()->urlimagen ,
			])->associate('App\Imgproductomodelo');

			if ($request->type=='checkout') {
          	//toast('Producto añadito al carrito','success','top-right');
            //return redirect()->route('resumen');
				return response()->json(['success', 400]);

			}else{
              //  toast('Producto añadito al carrito','success','top-right');
              //  return redirect()->back();


	return response()->json(['success', 400]);
			}



		}else{
			return response()->json(['success', 400]);
		}




	//	toast('Ciudad seleccionada','success','top-right');
	//	return redirect()->back();

	}


	public function sql_session(Request $request){

		$ciudad = Session::get('ciudad');
		$departamento = Session::get('departamento');


		$data= Ciudades::where('id', $ciudad)->first();
		$departamento= Estados::where('id', $departamento)->first();
		
		return response()->json([
			'ciudad'	=>$data,
			'departamento'=>	$departamento,
		]);

	}


	public function checksession(){

        if ( session()->get('ciudad')==null || session()->get('departamento')==null    ) {

        //return response()->json( session()->flash('error_code', 5) );
//Session::flash('error_code', 5);
	return response()->json(['error_code', 5]);
        }else{
        	return response()->json([
			'ciudad'	=> session()->get('ciudad'),
			'departamento'=>	session()->get('departamento'),
		]);
        }

	}






}
