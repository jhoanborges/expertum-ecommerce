<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categorian1modelo;


class ContactController extends Controller
{
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


		return view('layouts.contacto')->with([
			'categorias'=> $categorias,
			'cat2'=> $cat2,
			'id'=> $id,
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

}
