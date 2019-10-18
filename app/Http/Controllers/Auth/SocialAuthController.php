<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use Socialite;
use Carbon\Carbon;
use App\Cuentabancariamodelo;
use App\Notifications\UserSuccessfullyVerified;
use App\NewsLetter;
class SocialAuthController extends Controller
{

    // Metodo encargado de la redireccion a Facebook
    public function redirectToProvider($provider)
    {

        return Socialite::driver($provider)
        ->fields([
            'first_name', 'last_name', 'email', 'gender', 'birthday'
        ])->scopes([
            'email', 'user_birthday'
        ])
        ->redirect();
    }
    
    // Metodo encargado de obtener la informaci贸n del usuario
    public function handleProviderCallback($provider)
    {

        try {

        // Obtenemos los datos del usuario
            $social_user = Socialite::driver($provider)->fields([
                'first_name', 'last_name', 'email', 
                //'gender', 'birthday'
            ])->user(); 
            
            
        } catch (\Exception $exception) {
            toast('Error al obtener los datos de facebook','error','top-right');
            return redirect()->back()->withInput();
        }

        // Comprobamos si el usuario ya existe
        if ($user = User::where('email', $social_user->user['email'])->first() ) { 
            return $this->authAndRedirect($user); // Login y redirecci贸n
        } else {  
  try {
              //  $date = Carbon::createFromFormat('d/m/Y', $social_user->user['birthday'])->format('Y-m-d');

                         // En caso de que no exista creamos un nuevo usuario con sus datos.
                $user = User::create([
                    'name' => $social_user->user['first_name'],
                    'apellidos' => $social_user->user['last_name'],
                    'email' => $social_user->user['email'],
                    'username' => $social_user->user['email'],
                    'avatar' => $social_user->avatar,
                //    'fecha' => $date,
                ]);

try{
                if ($user) {
                   $newsletter = NewsLetter::create([
                    'id_user' => $user->id,
                    'active' => true,
                    'email' => $user->email,
                ]);
               }

   } catch (\Exception $exception) {}
   
               if ($user) {
                $user->notify(new UserSuccessfullyVerified($user));
            }

            return $this->authAndRedirect($user); // Login y redirecci贸n
            
        } catch (\Exception $exception) {
           // logger()->error($exception);
            toast('No se ha podido crear el usuario','error','top-right');
            return redirect()->back()->withInput();
        }


    }



}

    // Login y redirecci贸n
public function authAndRedirect($user)
{

    Auth::login($user);
    toast('Bienvenido'.' '.$user->name,'success','top-right');
    $link=str_replace( url('/'),'', session()->get('previousUrl', '/') );
    return redirect()->to($link);
     //   return redirect()->to('/home#');
}

}
