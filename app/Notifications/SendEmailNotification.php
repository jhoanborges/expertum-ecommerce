<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Parametromodelo;

class SendEmailNotification extends Notification
{
    use Queueable;
    public $data;
    public $subject;
    public $body;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data, $subject, $body)
    {
        $this->data = $data;
        $this->subject = $subject;
        $this->body = $body;
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
        $data= $this->data;
        $subject= $this->subject;
        $body= $this->body;
        $parametros = Parametromodelo::first();
        $logo= $parametros->logo;
      
        $route = route('welcome');
        
        return (new MailMessage)
        ->subject($subject)
        ->from( env('MAIL_FROM_ADDRESS') , env('APP_NAME'))
        ->replyTo( env('MAIL_FROM_ADDRESS') , env('APP_NAME'))
        ->markdown('emails.EmailToUser',[
            'name'=>$data['name'],
            'email'=>$data['email'],
            'subject'=>$subject,
            'body'=>$body,
            'route'=>$route,
            'logo'=>$logo,
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