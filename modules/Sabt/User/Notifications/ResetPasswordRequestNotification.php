<?php

namespace Sabt\User\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Sabt\User\Mail\ResetPasswordRequestMail;
use Sabt\User\Mail\VerifyCodeMail;
use Sabt\User\Services\VerifyCodeService;

class ResetPasswordRequestNotification extends Notification
{
    use Queueable;
    private $time = 120;

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
        return (new ResetPasswordRequestMail($code))
            ->to($notifiable->email);
    }


    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
