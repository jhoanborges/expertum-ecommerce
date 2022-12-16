<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordReset extends Notification
{
    use Queueable;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
/**
 * The password reset token.
 *
 * @var string
 */
public $token;

/**
 * Create a new notification instance.
 *
 * @return void
 */
public function __construct($token)
{
    $this->token = $token;
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
 * Build the mail representation of the notification.
 *
 * @param  mixed  $notifiable
 * @return \Illuminate\Notifications\Messages\MailMessage
 */
public function toMail($notifiable)
{
    //variables de parametros
    //customs emails text
    
    return (new MailMessage)
        ->line('Te ha llegado este mensaje porque recibimos una solicitud de restablecimiento de contraseña para tu cuenta.') // Here are the lines you can safely override
        ->action('Reestablecer contraseña', url('password/reset', $this->token))
        ->line('Si tu no hiciste la solicitud, no requieres ninguna acción. Ignora este mensaje.');
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
