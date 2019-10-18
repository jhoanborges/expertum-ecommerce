<?php

namespace App\Notifications;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegisteredSuccessfully extends Notification
{
    use Queueable;
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
        
        return (new MailMessage)
        //sacar esta variable del env
            ->from('no-reply@materilejuguetes.com')
            ->subject('Su cuenta creada exitosamente')
            ->greeting(sprintf('Hola %s', $user->name))
            ->line('Haz click en el siguiente link para activar tu cuenta.')
            ->action('Activar cuenta', route('activate.user', $user->activation_code))
            ->line('Gracias por registrarte');
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
