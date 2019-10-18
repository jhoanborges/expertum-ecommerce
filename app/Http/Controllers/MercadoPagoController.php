<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MP;
use DB;
use Log;
use Storage;
use Response;
use App\MercadoPago;
class MercadoPagoController extends Controller
{
    public function notifications_mp(Request $request)
    {
    $mercadopago= MercadoPago::where('predeterminado', true)->first();


//$mp = new MP ("888625201623812", "d4NiFuY3A80jR1LWaTYdv4hlGMeuIfOy");
    $mp = new MP ($mercadopago->client_id, $mercadopago->client_secret);
$params = ["access_token" => $mp->get_access_token()];

if (!isset($_GET["id"], $_GET["topic"]) || !ctype_digit($_GET["id"])) {
    http_response_code(400);
    return;
}

$id = (string)$_GET["id"];


    Storage::put('id.txt',$id);  
if($_GET["topic"] == 'payment'){
    $payment_info = $mp->get("/v1/payments/" . $id, $params, false);
    $merchant_order_info = $mp->get("/merchant_orders/" . $payment_info["response"]["order"]["id"], $params, false);
}else if($_GET["topic"] == 'merchant_order'){

}

    //Storage::put('merchant_order_info.txt',$merchant_order_info);  

    $merchant_order_info = $mp->get("/merchant_orders/".$id, $params, false);
    
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
        
        DB::table('test')->insert([
            'ref'=>$id,
            ]);

    return \Response::json(['HTTP/1.1 200 OK'], 200);

        //echo "release your items";
    }
    else{

return \Response::json(['HTTP/1.1 200 OK'], 400);
        //echo "dont release your items";
    }
    
}


        
    






    }


  
}
