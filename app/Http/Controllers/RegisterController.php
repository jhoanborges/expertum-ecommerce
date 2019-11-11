<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Clientemodelo;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;
 //use App\Mail\codigo_confirmacion;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

use App\Paismodelo;
use App\Departamentomodelo;
use App\Ciudades;
use App\Provedormodelo;
use App\Formapagomodelo;
use App\Tipocuentamodelo;
use App\Entidadbancariamodelo;
use App\Cuentabancariamodelo;
use App\Notifications\UserRegisteredSuccessfully;
use App\Categorian1modelo;
use Carbon\Carbon;
use App\Direcciones;
use App\Estados;
use Toastr;
use App\Notifications\UserSuccessfullyVerified;
use App\NewsLetter;

class RegisterController extends Controller
{


   use RegistersUsers;


   public function index(){

       return view ('auth.register');
   }



   protected $redirectTo = '/';


   public function __construct()
   {
       $this->middleware('guest');
   }


   protected function register_empresa(Request $request)
   {
       return view ('auth.register_empresa');
   }




   protected function register_empresa_store(Request $request)
   {

    $input = [
        'name' => $request->name,
        'razon_social' => $request->razon_social,
        'email' => $request->email,
        'nit' => $request->nit,
        'password' => $request->password,
    ];
    $rules = [
        'name'     => 'required|string|max:255',
        'razon_social' => 'required|max:255',
        'nit' => 'required|max:13',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    $messages = [
        'required' => 'El campo :attribute es requerido.',
        'email.unique' => 'Este email ya se encuentra registrado.',
        'email.email' => 'Introduzca un formato de email válido',
        'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
    ];


    $validator = Validator::make($input, $rules, $messages);

    if ($validator->fails()) {
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }else{

        try {
            $user = User::create([
               'name' => strtoupper($request->name),
               'razon_social' => $request->razon_social,
               'numeroidentificacion' => $request->nit,
               'apellidos' => $request->razon_social,
               'tipo_identificacion' => 2, //nit        
               'email' => strtoupper($request->email),
               'username' => $request->email,
               'password' => bcrypt($request->password),    
               'activation_code' => str_random(30).time(),
               'tipo' => 2,
             //'codigo_confirmacion' => $data['codigo_confirmacion']    
           ]);

if ($user) {
  try{
                  $newsletter = NewsLetter::create([
                'id_user' => $user->id,
                'active' => true,
                'email' => $user->email,

            ]);
                }catch(\Exception $e){}
 
}

        $user->notify(new UserRegisteredSuccessfully($user));
           alert()->success('¡Enhorabuena!','Tu cuenta ha sido creada exitosamente. Hemos enviado un correo electrónico a ' .$request->email.'');
           return redirect()->route('home');    
       } catch (\Exception $exception) {
         alert()->error('Error!','No se ha podido crear el usuario');
        return redirect()->back()->withInput();
    }

}





}

















   protected function register(Request $request)
   {


    $input = [
        'name' => $request->name,
        'apellido' => $request->apellido,
        'email' => $request->email,
        'password' => $request->password,
       // 'password_confirmation' => $request->password_confirmation,
    ];
    $rules = [
        'name'     => 'required|string|max:255',
        'apellido' => 'required|max:255',
        'email'    => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8',
    ];

    $messages = [
        'required' => 'El campo :attribute es requerido.',
        'email.unique' => 'Este email ya se encuentra registrado.',
        'email.email' => 'Introduzca un formato de email válido',
        'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
    ];


    $validator = Validator::make($input, $rules, $messages);

    if ($validator->fails()) {

//aca enviar toastr para las notificaciones|
        return redirect()->back()
        ->withErrors($validator)
        ->withInput();
    }else{

       // try {

            $user = User::create([
               'name' => strtoupper($request->name),
               'apellidos' => strtoupper($request->apellido),
               'email' => strtoupper($request->email),
               'username' => $request->email,
               'password' => bcrypt($request->password),    
               'activation_code' => str_random(30).time(),
           ]);

/*
            if ($user) {
                try{

               $newsletter = NewsLetter::create([
                'id_user' => $user->id,
                'active' => true,
                'email' => $user->email,

            ]);
                         }catch(\Exception $e){}
           }

           $direccion_user = Direcciones::create([
            'id_pais' => strtoupper($request->nombre_pais),
            'id_departamento' => strtoupper($request->state),
            'id_ciudad' => strtoupper($request->city),
            'barrio' => strtoupper($request->barrio),
            'direccion' => strtoupper($request->direcciondomicilio),
            'telefono' => $request->telefono,  
            'name' => strtoupper($request->name),
            'tipo_identificacion' => $request->tipo_identificacion,
            'numero_identificacion' => $request->numerodocumento, 
            'observaciones' => $request->observaciones,  
            'user_id' => bcrypt($user->id),
        ]);
*/
           $user->notify(new UserRegisteredSuccessfully($user));
           alert()->success('¡Enhorabuena!','Tu cuenta ha sido creada exitosamente. Hemos enviado un correo electrónico a ' .$request->email.'');
           return redirect()->route('home');    
       /*} catch (\Exception $exception) {
        toast('No se ha podido crear el usuario','error','top-right');
        return redirect()->back()->withInput();
    }*/

    
}





}





public function activateUser(string $activationCode)
{
    try {
        $user = User::where('activation_code', $activationCode)->first();
        if (!$user) {
        toast('Este usuario no existe','info','top-right');

           return redirect()->route('home');    
        }

        $user->status= 1;
        $user->activation_code = null;
        $user->save();
        $user->notify(new UserSuccessfullyVerified($user));
        toast('Tu cuenta ha sido activada exitosamente','success','top-right');
        auth()->login($user);

    } catch (\Exception $exception) {
        toast('No hemos podido activar tu usuario','error','top-right');
    }

    return redirect()->to('/home');
}



}
