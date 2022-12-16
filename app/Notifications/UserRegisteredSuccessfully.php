<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
Use App\Categorian1modelo;
use App\RedesSociales;
use App\Parametromodelo;


class UserRegisteredSuccessfully extends Notification
{
    use Queueable;
    public $categories;
    public $redes;
    public $contact_url;
    public $contact_email;
    public $verification_url;
       /**
     * @var User
     */

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
     $this->user = $user;

     $this->categories=Categorian1modelo::take(5)->get();
     $this->redes=RedesSociales::take(5)->get();
     $this->contact_url=env('APP_URL').'contacto';
     $this->contact_email=env('CONTACT_EMAIL');
     //$this->verification_url=route('activate.user', $user->activation_code);
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

      /** @var User $user */
      $user = $this->user;
        $parametros= Parametromodelo::first();


      $categories=Categorian1modelo::take(5)->get();
      $redes=RedesSociales::take(5)->get();
      $contact_url=env('APP_URL').'contacto';
      $contact_email=env('CONTACT_EMAIL');

      $email_required_on_register = $parametros->email_required_on_register;
      if($email_required_on_register === 1){
        $verification_url=route('activate.user', $user->activation_code);
      }else{
        $verification_url= null;
      }

      //return $this->from(env('MAIL_USERNAME'))
      return (new MailMessage)
      ->from(env('MAIL_FROM_ADDRESS'))
      ->subject('Bienvenido a '.$parametros->nombre_tienda )
      ->markdown('emails.UserRegistered',[
        'user'=>$user->name,
        'categories'=>$categories,
        'redes'=>$redes,
        'contact_url'=>$contact_url,
        'contact_email'=>$contact_email,
        'verification_url'=>$verification_url,
    ]);
        /*
        return (new MailMessage)
        //sacar esta variable del env
            ->from(env('MAIL_USERNAME'))
            ->subject('Su cuenta creada exitosamente')
            -> (sprintf('Hola %s ', $user->name))
            ->line('Haz click en el siguiente link para activar tu cuenta.')
            ->action('Activar cuenta', route('activate.user', $user->activation_code))
            ->line('Gracias por registrarte');
            */
        }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
