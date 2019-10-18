<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Parametromodelo;

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
        return (new MailMessage)
        //sacar esta variable del env
            ->from('no-reply@materilejuguetes.com')
            ->subject('Bienvenido a'.$parametros->nombre_tienda )
            ->greeting(sprintf('Hola %s', $user->name))
            ->line('Has confirmado con exito tu cuenta. Ya puede iniciar sesión con tu cuenta.')
            ->action('Iniciar sesión', route('login'));
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
