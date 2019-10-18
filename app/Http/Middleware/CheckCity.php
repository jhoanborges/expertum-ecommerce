<?php

namespace App\Http\Middleware;

use Closure;

use Gloudemans\Shoppingcart\Facades\Cart;
use Validator;
use Auth;
use App\ShoppingCart;
use App\Productomodelo;
use DB;
use Session;
use App\Categorian1modelo;
use Alert;

class CheckCity
{

    public function handle($request, Closure $next)
    {

        if (session()->get('ciudad')==null) {

            return redirect()->back()->with([
            	'error_code'=> 5,
            	'id'=> $request->id,
            ]);
        }
      //dd($request->all());
        	return $next($request);
        


}

}
