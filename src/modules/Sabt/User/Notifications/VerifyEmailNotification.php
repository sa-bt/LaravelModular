<?php

namespace Sabt\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sabt\User\Mail\VerifyCodeMail;
use Sabt\User\Services\VerifyCodeService;

class VerifyEmailNotification extends Notification
{
    use Queueable;

    private $time = 60 * 120; # for 2 hours

    public function __construct()
    {
        //
    }


    public function via($notifiable)
    {
        return ['mail'];
    }


    public function toMail($notifiable)
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store($notifiable->id, $code, $this->time);
        return (new VerifyCodeMail($code))
            ->to($notifiable->email);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
