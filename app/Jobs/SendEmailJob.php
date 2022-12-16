<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Notifications\SendEmailNotification;
use Notification;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $user;
    public $subject;
    public $body;
    public $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $user, $subject, $body)
    {
        $this->user = $user;
        $this->subject = $subject;
        $this->body = $body;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user= $this->user;
        $subject= $this->subject;
        $body= $this->body;
        $email= $this->email;
        
        Notification::route('mail', $email)->notify(
            new SendEmailNotification($user, $subject,$body) 
        );
    }
}