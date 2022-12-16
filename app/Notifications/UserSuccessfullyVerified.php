<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Parametromodelo;
Use App\Categorian1modelo;
use App\RedesSociales;

class UserSuccessfullyVerified extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $parametros= Parametromodelo::first();
        $user = $this->user;


        $categories=Categorian1modelo::take(5)->get();
        $redes=RedesSociales::take(5)->get();
        $contact_url=env('APP_URL').'contacto';
        $contact_email=env('CONTACT_EMAIL');

        return (new MailMessage)
        ->from(env('MAIL_FROM_ADDRESS'))
        ->subject('Has confirmado tu correo en '.$parametros->nombre_tienda )
        ->markdown('emails.UserVerified',[
            'user'=>$user->name,
            'categories'=>$categories,
            'redes'=>$redes,
            'contact_url'=>$contact_url,
            'contact_email'=>$contact_email,
        ]);

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
