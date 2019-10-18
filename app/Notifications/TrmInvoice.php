<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Carbon\Carbon;
use DB;
use App\Trmmodelo;
class TrmInvoice extends Notification
{
    use Queueable;
public $trm;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($trm)
    {

          $this->trm = $trm;

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
        $now =Carbon::now('America/Bogota');
    
          $trm = $this->trm ;

        return (new MailMessage)
            ->from(env('ADMIN_MAIL'))
            ->subject('TRM del día')
         ->greeting('Estimado usuario:')
            ->line('La tasa TRM del día ha sido actualizada con éxito. Si requiere ayuda adicional comuniquese con el equipo de EXPERTUM y su solicitud será atendida de manera rápida y eficáz.')
            //->action('Activar cuenta', route('activate.user', $user->activation_code))
              ->line('TRM:'.''.$trm,'')
              ->line('fecha:'.''.$now,'')
            ->line('Gracias.');

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
