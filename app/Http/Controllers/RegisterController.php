<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\User;
use App\Clientemodelo;
use App\Parametromodelo;
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
use App\Productomodelo;
use Toastr;
use App\Notifications\UserSuccessfullyVerified;
use App\NewsLetter;

use App\Identificacion;

use App\Jobs\SendEmailJob;

class RegisterController extends Controller
{


 use RegistersUsers;


 public function index(){

  $identificacion=identificacion::all();
  /*
    $identificacion = identificacion::query();
    $identificacion->when(Auth::user()->tipo == 2, function ($q) {
      return $q->where('id', 2)->get();
    });
  $identificacion->when(Auth::user()->tipo != 2, function ($q) {
    return  $q->where('id','!=', 2)->get();
  });
  $identificacion= $identificacion->get();
  */
  $ids2= Productomodelo::
  where('estado', true)
  ->with('hasManyImagenes')
  ->where('productos.cantidad', '!=', 0)
//->where('id_categorian1', '=', $id)
  ->pluck('id');

    return view ('auth.register')->with([
    'identificacion' => $identificacion,
    'ids2' => $ids2,
  ]);

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
    /*

  $secret = env('GOOGLE_RECAPTCHA_SECRET');

  if (isset($_POST['g-recaptcha-response'])) {
    $captcha = $_POST['g-recaptcha-response'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = array(
    'secret' => $secret,
    'response' => $captcha,
    'remoteip' => $_SERVER['REMOTE_ADDR']
    );

    $curlConfig = array(
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_POSTFIELDS => $data
    );

    $ch = curl_init();
    curl_setopt_array($ch, $curlConfig);
    $response = curl_exec($ch);
    curl_close($ch);
  }

  $jsonResponse = json_decode($response);

  if ($jsonResponse->success === true) {

  // Si el código es correcto, seguimos procesando el formulario como siempre

  } else {

  // Si el código no es válido, lanzamos mensaje de error al usuario
    toast('error recaptcha','error','top-right');
      //return redirect()->route('home');

    return redirect()->back()
    ->withInput();

  }
 */


  /*
  $recaptcha = $_POST["g-recaptcha-response"];

  $url = 'https://www.google.com/recaptcha/api/siteverify';
  $data = array(
    'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
    'secret' => env('GOOGLE_RECAPTCHA_SECRET'),
    'response' => $recaptcha
  );
  $options = array(
    'http' => array (
      'method' => 'POST',
      'content' => http_build_query($data)
    )
  );
  $context  = stream_context_create($options);
  $verify = file_get_contents($url, false, $context);
  $captcha_success = json_decode($verify);
  if ($captcha_success->success) {
    // No eres un robot, continuamos con el envío del email
    // ...
    // ...
  } else {
      //alert()->success('¡Enhorabuena!','Tu cuenta ha sido creada exitosamente. Hemos enviado un correo electrónico a ' .$request->email.'');
      toast('error recaptcha','error','top-right');
      return redirect()->route('home');
  }
  */




  $input = [
    'name' => $request->name,
    'apellido' => $request->apellido,
    'numeroidentificacion' => $request->numeroidentificacion,
    //'telefono' => $request->telefono,
    'email' => $request->email,
    'password' => $request->password,
       // 'password_confirmation' => $request->password_confirmation,
  ];
  $rules = [
    'name'     => 'required|string|max:255',
    'apellido' => 'required|max:255',
    //'numeroidentificacion' => 'required|numeroidentificacion|max:255|unique:users',
    //'telefono' => 'required|max:255',
    'email'    => 'required|string|email|max:255|unique:users',
    'password' => 'required|string|min:8',
  ];

  $messages = [
    'required' => 'El campo :attribute es requerido.',
    'email.unique' => 'Este email ya se encuentra registrado.',
    'email.email' => 'Introduzca un formato de email válido',
    //'numeroidentificacion.unique' => 'Esta identificación ya se encuentra registrada.',
    //'telefono.telefono' => 'El campo telefono es requerido.',
    'password.min' => 'La contraseña debe contener al menos 8 caracteres.',
  ];


  $validator = Validator::make($input, $rules, $messages);


  if ($validator->fails()) {

    //aca enviar toastr para las notificaciones|

    //return false;

    //$data = array('status' => 'error');
    //echo json_encode($data,  JSON_FORCE_OBJECT);

    //echo "error";


    return redirect()->back()
    ->withErrors($validator)
    ->withInput();
  }

    $parametros = Parametromodelo::first();
    $email_required_on_register = $parametros->email_required_on_register;


      try {

      $user = User::create([
       'name' => strtoupper($request->name),
       'apellidos' => strtoupper($request->apellido),
       'tipo_identificacion' => strtoupper($request->tipo_identificacion),
       'numeroidentificacion' => strtoupper($request->numeroidentificacion),
       'id_country' => '1',
       'id_region' => $request->state,
       'id_city' => $request->city,
       'direccion' => $request->direccion,
       'telefono' => strtoupper($request->telefono),
       'email' => strtoupper($request->email),
       'username' => $request->email,
       'password' => bcrypt($request->password),
       'activation_code' => $email_required_on_register === 1 ? str_random(30).time() : null,
       'status' => $email_required_on_register === 1 ? 0: 1,
     ]);

    }catch (\Exception $exception) {
        toast('No se ha podido crear el usuario','error','top-right');
      return redirect()->back()->withInput();
    }

      try {
        if($email_required_on_register === 1){
          $user->notify(new UserRegisteredSuccessfully($user));
          alert()->success('¡Activación requerida!','Por favor revisa en la BANDEJA DE ENTRADA o en la carpeta SPAM para CONFIRMAR la propiedad de ' .$request->email.' '. 'y ACTIVAR la cuenta')->autoclose(0);
          return redirect()->route('home');
          $user->notify(new UserRegisteredSuccessfully($user));

        }else{
          //enviar email de bienvenida
        $name = $user->name;
        $subject = 'Bienvenido '. $name . '! ';
        $body = "Tu cuenta ha sido creada y activada exitosamente";

        $body = $body . '<br> <div style="background-color: ghostwhite; border-radius: 4px; padding: 20px 30px;">
        <center>
        <p><strong>Datos de acceso</p>
        <p><strong>Email: </strong> '.$request->email.'</p>
        <p><strong>Clave: </strong> '.$request->password.'</p>
        </center>
        </div>';

        try{
            SendEmailJob::dispatch($user->email, $user, $subject, $body);
          }catch(\Exception $e){
            \Log::error($e);
          }

          auth()->login($user);


        }
      }catch (\Exception $exception) {}

      alert()->success('Tu cuenta se ha creado con éxito.');
      return redirect()->route('home');




}





public function activateUser(string $activationCode)
{
  try {
    $user = User::where('activation_code', $activationCode)->first();
    if (!$user) {
      toast('El código de activación es inválido expirado','info','top-right');
      return redirect()->route('home');
    }

    $user->status= 1;
    $user->activation_code = null;
    $user->save();

    try {
      $user->notify(new UserSuccessfullyVerified($user));
    } catch (\Exception $exception) {
      //no se ha podido enviar el correo
    }

    toast('Tu cuenta ha sido activada exitosamente','success','top-right');
    auth()->login($user);

  } catch (\Exception $exception) {
    toast('No hemos podido activar tu usuario','error','top-right');
  }

  return redirect()->to('/home');
}



}
