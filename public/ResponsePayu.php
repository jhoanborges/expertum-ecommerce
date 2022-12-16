<?php
//insert laravel dentro de la funcion
require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../bootstrap/app.php';
$app = require __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
  $request = Illuminate\Http\Request::capture()
);
//insert laravel dentro de la funcion

use App\Pasarelas;

$pasarela = Pasarelas::where('name', "PAYU")->first();

$ApiKey =  $pasarela->apikey;
$merchant_id = $pasarela->merchantid;
$TX_VALUE = $_REQUEST['TX_VALUE'];
$New_value = number_format($TX_VALUE, 2, '.', '');
$lapPaymentMethod = $_REQUEST['lapPaymentMethod'];
$lapPaymentMethodType = $_REQUEST['lapPaymentMethodType'];

/*
$referenceCode = $_REQUEST['referenceCode'];
$currency = $_REQUEST['currency'];
$transactionState = $_REQUEST['transactionState'];
$firma_cadena = "$ApiKey~$merchant_id~$referenceCode~$New_value~$currency~$transactionState";
$firmacreada = md5($firma_cadena);
$firma = $_REQUEST['signature'];
$reference_pol = $_REQUEST['reference_pol'];
$cus = $_REQUEST['cus'];
$extra1 = $_REQUEST['description'];
$pseBank = $_REQUEST['pseBank'];
$extra1 = $_REQUEST['extra1'];
*/

$transactionId = $_REQUEST['transactionId'];

if ($_REQUEST['transactionState'] == 4 ){
  $estadoTx = "APROBADA";
}
else if ($_REQUEST['transactionState'] == 6 ){
  $estadoTx = "RECHAZADA";
}
else if ($_REQUEST['transactionState'] == 104 ){
  $estadoTx = "ERROR";
}
else if ($_REQUEST['transactionState'] == 7 ){
  $estadoTx = "PENDIENTE";
}
else {
  $estadoTx = $_REQUEST['mensaje'];
}

header("Location: shoppingResponse?estadoTx=$estadoTx&valor=$New_value&metodopago=$lapPaymentMethod&tipopago=$lapPaymentMethodType");


?>