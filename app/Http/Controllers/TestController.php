<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;
use MP;
use App\Categoria6;
use App\Categoria7;
use App\Productomodelo;
class TestController extends Controller
{
    public function index(){


$mp = new MP ("888625201623812", "d4NiFuY3A80jR1LWaTYdv4hlGMeuIfOy");
$params = ["access_token" => $mp->get_access_token()];//

$id=(string)4264457550;

	//$merchant_order_info = $mp->get("/merchant_orders/" . $id, $params, false);
	$payment_info = $mp->get("/v1/payments/" . $id, $params, false);
		$merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["order"]["id"], $params, false);


	 dd($merchant_order_info);

if ($merchant_order_info["status"] == 200) {


	$transaction_amount_payments= 0;
	$transaction_amount_order = $merchant_order_info["response"]["total_amount"];
    $payments=$merchant_order_info["response"]["payments"];




    foreach ($payments as  $payment) {
    	if($payment['status'] == 'approved'){
	    	$transaction_amount_payments += $payment['transaction_amount'];
	    }
    }


    if($transaction_amount_payments >= $transaction_amount_order){

           	Storage::put('APROBADA.txt',$transaction_amount_order);
    	echo "release your items";
    }
    else{
		echo "dont release your items";
	}

}






























$id=171;

//$categoria7 = Categoria7::where('id' , $id)->get();
//$categoria7 = Categoria7::with('categories')->where('id' , $id)->get();

//$productos= Productomodelo::where('id' , 424)->with('filtros')->get();
$categoria7 = Categoria7::find($id);
$productos= $categoria7->productos()->get();

dd($productos);



dd('test');




    			$id_departamento= 1398;
		$id_ciudad=5156;


$dep_code=DB::table('region')->where('id' , $id_departamento)->value('code');
$city_code=DB::table('city')->where('id' , $id_ciudad)->value('code');
$code= $dep_code.$city_code.'000';

$dep_name=DB::table('region')->where('id' , $id_departamento)->value('region');
$city_name=DB::table('city')->where('id' , $id_ciudad)->value('city');

/*
		$ciudad_saf=DB::table('city')
		->where('code' , $ciudad)
		->where('region_id' , $region_id)
		->value('city');
*/
		$ciu = $this->remove($city_name);
		$dep = $this->remove($dep_name);

		$cadena= $dep.'-'.$ciu.'-'.$code;

dd($cadena);


$total=0;
			foreach (Cart::content() as $i => $product){
				$id=$product->options->id_producto;
				$data = DB::table('productos')->where('id' , $id)->first();
		$pesovolumen= ($data->largo * $data->ancho * $data->alto) / 2500;
		$total=$total+$pesovolumen;
		}

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
