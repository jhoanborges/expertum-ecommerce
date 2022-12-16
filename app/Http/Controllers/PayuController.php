<?php

namespace App\Http\Controllers;

Use Alert;
use DB;
use App\Category;
use Session;
use Illuminate\Http\Request;
use Validator;
use Gloudemans\Shoppingcart\Facades\Cart;

use App\Parametromodelo;

class PayuController extends Controller
{

    public function index()
    {
        $this->clear();
        return view('layouts.shoppingResponse')->with([
            'marcas'=> "",
        ]);
        //return view('partials.main_index');
    }


    public function clear() {
        Cart::instance('default')->destroy();
        //toast('Carrito de compras limpiado','success','top-right');
        return redirect()->route('welcome');
    }


}
