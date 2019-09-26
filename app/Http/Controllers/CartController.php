<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;
use Cart;

class CartController extends Controller
{
    public function index(){

        Cart::instance('shopping')->destroy();

        Cart::instance('shopping')->add(
           ['id' => '4832k',
           'name' => 'Excava Tiranosaurio Rex',
           'qty' => 1,
           'price' => 1000,
           'weight'=>0,
           'options' => [
            'iva' => 19,
            'avaliable' => true,
            'brand' => '4M-INDUSTRIAL',
        ]]
       );


        return view('layouts.cart');
    }

    public function get(){
      // Cart::instance('shopping')->add('192ao12', 'Product 1', 1, 9.99, 550);

// Get the content of the 'shopping' cart
     //  $cart =Cart::instance('shopping')->content();

    }

}
