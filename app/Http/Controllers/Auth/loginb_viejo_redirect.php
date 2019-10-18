
<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

use Illuminate\Http\Request;
Use Alert;
use Auth;
use App\User;
use App\ShoppingCart;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Validation\ValidationException;
use Illuminate\Auth\AuthenticationException;
use DB;
use Carbon\Carbon;
use App\Categorian1modelo;

class LoginController extends Controller
{

     use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


     protected function validateLogin(Request $request)
     {
     	$this->validate($request, [

     		'email' => 'required|string',
     		'password' => 'required',
                //$this->username() => 'required|exists:usersas,' . $this->username() . ',status,1',
     	],
     	[
     		'email.required' => 'Username or email is required',
     		'password.required' => 'Password is required',
     	]
     );


    }

    public function showLoginForm()
    {

    	session()->put('previousUrl', url()->previous());


    	return view('auth.login')->with([
        ]);

    }


    public function redirectTo(){

    	if (Auth::check()) {
    		$user = Auth::user();
    		$id = Auth::id();
    		$email = Auth::user()->email;

            Cart::instance('favoritos')->restore($email);
//restaurar carrito
            /*
    		Cart::restore($id);
    		ShoppingCart::deleteCartRecord($id, 'default');
    		Cart::instance('default')->store($id);
    		Cart::instance('favoritos')->restore($email);
            */
/*
verificar_si_producto_carrito_existe();
update_price();
*//*
    		if ( Cart::instance('default')->count() >0) {

    			toast('¡Bienvenido!' . '&nbsp;'.'&nbsp;'. $user->name .'&nbsp;'.'&nbsp;'. 'Hemos restaurado su carrito de compras.Verifica los productos añadidos.','success','top-right');
    			return str_replace( url('/'),'', session()->get('previousUrl', '/') );
*/
    		//}else {
    			toast('¡Bienvenido!' . '&nbsp;'.'&nbsp;'. $user->name ,'success','top-right');
    			return str_replace( url('/'),'', session()->get('previousUrl', '/') );

    		//}   

    	}else{
    		return '/login';
    	}

    }

    public function logout(Request $request)
    {


    	$this->guard()->logout();
    	$request->session()->flush();
    	$request->session()->regenerate();
    	toast('¡Éxito! Su sesión ha sido cerrada','success','top-right');
    	//return redirect('/');
        return redirect()->back();
    }
/*
protected function credentials(Request $request)
{
         toast('¡Estimado usuario! Debe confirmar su cuenta de correo electrónico','warning','top-right');
    // The user is active, not suspended, and exists.
            return array_merge($request->only($this->username(), 'password'), ['status' => 1]);
}
*/

public function attemptLogin(Request $request) {


	if ( Auth::attempt( ['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember )  || 
		Auth::attempt( ['username' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember ) ) {
            // Authentication passed...
		return redirect()->intended( '/' );
	}else{



	$existe = User::where("email", $request->email)->first();
	$existe2 = User::where("username", $request->email)->first();
    $status = User::select('status')->where('email', $request->email )->value('status');

		if($existe!= null || $existe2!= null ) {

            if ($status==0) {
           toast('¡Estimado usuario! Debe confirmar su dirección de correo electrónico','info','top-right');
                # code...
            }else{
        toast('¡Estimado usuario! Existe un error en sus credenciales de acceso. Verifique e intente de nuevo','warning','top-right');
            }
        //  return 0;
		}else{
			toast('Error! Este usuario no existe','error','top-right');
			//return 0;
		}

	}



	
}




}
