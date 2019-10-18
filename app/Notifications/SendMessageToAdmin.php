<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SendMessageToAdmin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {

        $this->data = $data;
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
           $data = $this->data;


        return (new MailMessage)
            ->from( $data['email'] )
            ->subject('Tienes un nuevo mensaje desde tu tienda')
            ->greeting(sprintf('Me llamo %s', $data['name'] ))
            ->line($data['message'])
            ->line('Este mensaje ha sido generado automaticamente desde tu tienda online.');
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
