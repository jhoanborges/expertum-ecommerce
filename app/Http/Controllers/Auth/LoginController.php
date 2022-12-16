<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth; 
use App\User;

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



    public function attemptLogin($request) {


        if ( Auth::attempt( ['email' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember )  || 
            Auth::attempt( ['username' => $request->email, 'password' => $request->password, 'status' => 1], $request->remember ) ) {
            // Authentication passed...
            return true;
      //return redirect()->intended( '/' );
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