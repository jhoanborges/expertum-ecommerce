<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorian1modelo;
use Validator;
use Notification;
use App\Notifications\SendEmailToAdmin;
use App\Parametromodelo;
use App\Productomodelo;
use App\Traits\SEOTrait;

class ContactController extends Controller
{
	use SEOTrait;

	public function index()
	{

		$categorias=Categorian1modelo::orderBy('nombrecategoria' ,   'asc')->get();
		$cat2=1;
		$id=null;


		return view('layouts.contact')->with([
			'categorias'=> $categorias,
			'cat2'=> $cat2,
			'id'=> $id,
		]);

	}


	public function about_us()
	{
		$categorias=Categorian1modelo::orderBy('nombrecategoria' ,   'asc')->get();
		$cat2=1;
		$id=null;

		$this->setSEOManager();
		$ids2= Productomodelo::
		where('estado', true)
		->with('hasManyImagenes')
		->where('productos.cantidad', '!=', 0)
		//->where('id_categorian1', '=', $id)
		->pluck('id');
		
		
		return view('layouts.contacto')->with([
			'categorias'=> $categorias,
			'cat2'=> $cat2,
			'id'=> $id,
			'ids2'=> $ids2,
		]);

	}

	public function faq()
	{
		$categorias=Categorian1modelo::orderBy('nombrecategoria' ,   'asc')->get();
		$cat2=1;
		$id=null;


		return view('layouts.faq')->with([
			'categorias'=> $categorias,
			'cat2'=> $cat2,
			'id'=> $id,
		]);

	}

	public function sitemap()
	{
		$categorias=Categorian1modelo::orderBy('nombrecategoria' ,   'asc')->get();
		$cat2=1;
		$id=null;


		return view('layouts.sitemap')->with([
			'categorias'=> $categorias,
			'cat2'=> $cat2,
			'id'=> $id,
		]);

	}






	public function send(Request $request){

		$rules = [
			'my_name'   => 'honeypot',
			'my_time'   => 'required|honeytime:5',
            'recaptcha' => 'required|recaptcha',
			'name' => 'required|string|max:191',
			'email' => 'required|email|max:191',
			'message' => 'required|string|max:2000',
			'subject' => 'required|string|max:191',
		];

		$messages = [];

		$validator = Validator::make($request->all(), $rules, $messages);


		if ($validator->fails()) {
			return response()
			->json([
				'success' => false,
				'message' => 'Han ocurrido errores en la creación del cliente',
				'errors' =>  $validator->messages()
			],404);
		}


		$parametros=  Parametromodelo::first();

		if (!$parametros) {
			return response()
			->json([
				'success' => false,
				'errors' => ['error'=> 'Ha ocurrido un error inesperado al enviar el email.'],
				'message' => 'Ha ocurrido un error inesperado.',
			],404);
		}

		try{
			Notification::route('mail', $parametros->correo)->notify(new SendEmailToAdmin($request->all()) );
		}catch(\Exception $e){
			return response()
			->json([
				'success' => false,
				'errors' => ['error'=> 'Ha ocurrido un error inesperado al enviar el email.'],
				'message' => 'Ha ocurrido un error inesperado.',
			],404);
		}

		return response()
		->json([
			'success' => true,
			'message' => 'Email enviado satisfactoriamente']);
	}


}
