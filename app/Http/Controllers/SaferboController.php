<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SaferboOptions;
use DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\ShoppingCart;

class SaferboController extends Controller
{

     public function flete_value(Request $request){

$departamento= $request->departamento;
$ciudad=$request->ciudad;
$code= $departamento.$ciudad.'000';

$departamento_saf=DB::table('region')->where('code' , $departamento)->value('region');
$region_id=DB::table('region')->where('code' , $departamento)->value('id');

$ciudad_saf=DB::table('city')
->where('code' , $ciudad)
->where('region_id' , $region_id)
->value('city');

$ciu = $this->remove($ciudad_saf);
$dep = $this->remove($departamento_saf);

$cadena= $dep.'-'.$ciu.'-'.$code;


/*
$dsnitr='';
$dsnombrer='';
$dstelr='';
$dsdirr='';
*/
$saf = SaferboOptions::first();

$total=0;
			foreach (Cart::content() as $i => $product){
				$id=$product->options->id_producto;
				$data = DB::table('productos')->where('id' , $id)->first();	
		$pesovolumen= ($data->largo * $data->ancho * $data->alto) / 2500;
		$total=$total+$pesovolumen;
		}


$idciudadestino=$cadena;
$idciudadespacho=$saf->cadena;

$dskilos=2;
$dsvalordec=500000;

$ds_largo='';
$ds_ancho='';
$ds_alto='';

$ds_pesovol=$total;

$ds_contraentrega=0;
$tipoacceso=1;
$tipodatos=2;
$dsunidad=1;
//codigo de saferbo
$codigo='999997';
$idnegociacion=1 ;// Valor Fij'o
$idtipoenvio=3 ; // Valor Fij'o
$idtipoliquidacion=1; //Valor fij'o
$idtarifaxtrayecto=2;
$dsobs_1='obs';
$dsobs_2='obs2';
$dsobs_3='obs3';
$dscodigodestinatario=0000;
$dsnitd=71777132;  //Documento de Identificacion
$dsnombred='JUAN FERNANDO';
$dsteld=2385370 ;  //Si no se tiene se coloca cer'o
$dsdird='CALLE 30 75 23';
$dsvalorrecaudar=125000;

$url="https://app.saferbo.com/webservices/ws.generar.guias.php";
// estas variables se validan  en caso de estar vacias
if ($idtipoliquidacion=="") $idtipoliquidacion=1;
// estas variables son fijas

// fin variables fijas
// VARIABLES QUE SE PASAN.
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
$var = curl_exec($c); // respuesta del envio de variables


if (curl_error($c)) {
    $error_msg = curl_error($c);
}

$array = explode('|', $var);


        return response()->json($array[3]);
//      return response()->json($var);



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
