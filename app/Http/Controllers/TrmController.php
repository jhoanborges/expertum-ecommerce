<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Trmmodelo;
use Carbon\Carbon;
use Notification;
use App\User;
use Mail;
use App\Notifications\TrmInvoice;

class TrmController extends Controller
{

public function delete()
	{	
			$now =Carbon::now('America/Bogota')->format('Y-m-d');


			$trm =DB:: table('trm')->select('valor_trm')
			->where('fecha', $now)->delete();
		 toast('TRM borrado','success','top-right');
			return redirect()->route('welcome');
	}


	public function webservistrm()
	{	

		$url = "http://app.docm.co/prod/Dmservices/Utilities.svc/GetTRM";
		$ch = curl_init();
		curl_setopt ($ch, CURLOPT_URL,$url);
		curl_setopt ($ch, CURLOPT_HEADER, 0);
		curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
		$page = trim(curl_exec($ch));
		$rest =substr($page,1,-1);
		$trm  = $rest;

		$fechaactual =date("Y-m-d");

		$resultado =DB:: table('trm')
		->select('fecha')
		->get();

		$oldtrm =DB:: table('trm')->select('valor_trm')->orderBy('id', 'DESC')->value('valor_trm');


		$arr = [];
		$validacion=null;
		foreach($resultado as $row)
		{
			$validacion = $arr[] = (array) $row;
		}
		$verificacion =$validacion['fecha'];
		$now =Carbon::now('America/Bogota');



		if ( ($verificacion==$fechaactual) && ($oldtrm == $trm)  ){

			$id =DB:: table('trm')->select('id')->where('valor_trm' , $trm)
			->where('fecha' , $fechaactual)
			->value('id');


 	$trm =DB:: table('trm')->select('valor_trm')->orderBy('id', 'DESC')->value('valor_trm');

(new User)->forceFill([   'name' => 'Nombre de la empresa',   'email' => 'walmeida@expertum.co',])->notify(new TrmInvoice($trm)  );
 			
 			toast('TRM actualizado','success','top-right');
			return redirect()->route('welcome');
			//aca enviar un correo electronico al usuario de que su trm ha sido renovada  con la tasa y fecha
			/*$mensaje = 'la TRM para la fecha'.$fechaactual.' no se puede volver a crear';
			return redirect()->route('trm.index')->with('mensajeerror',$mensaje);*/
		}  else {
			$creado = Trmmodelo::create([
				'fecha'=>$fechaactual,
				'valor_trm' =>$trm
			]);
	
 	$trm =DB:: table('trm')->select('valor_trm')->orderBy('id', 'DESC')->value('valor_trm');

(new User)->forceFill([   'name' => 'Nombre de la empresa',   'email' => 'walmeida@expertum.co',])->notify(new TrmInvoice($trm)  );
 toast('TRM actualizado','success','top-right');
			return redirect()->route('welcome');
		/*	$mensaje = $creado? 'Trm creado correctamente':'El Trm no pudo ser creado';
			return redirect()->route('trm.index')->with('mensaje',$mensaje);*/
		}  

  }


}
