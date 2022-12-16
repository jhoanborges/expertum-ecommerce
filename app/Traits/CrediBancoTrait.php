<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\Pasarelas;
use Carbon\Carbon;

trait CrediBancoTrait
{
	
	public function createOrderCrediBanco($amount, $factura)
	{

		$data = [];

		$client = new \GuzzleHttp\Client();

        $pasarela = Pasarelas::
        where('name','LIKE','%'.'ipay'.'%')
        ->orWhere('name','LIKE','%'.'credibanco'.'%')
        ->first();

        $username = $pasarela->username;
        $password = $pasarela->password;
        $endpoint = $pasarela->endpoint;
        $return_url = $pasarela->return_url;

		//try{
		$order_number = $factura;
		$amount = $amount * 100;


		$res = $client->request('POST', $endpoint.'?amount='.$amount.'&userName='.$username . '&password='. $password . '&orderNumber='.$order_number. '&returnUrl='.$return_url,[
			'headers' => [
				'Content-Type'=> 'application/json',
			]
		]);
		$result =  json_decode($res->getBody(), true);
		return $result;
	}



}