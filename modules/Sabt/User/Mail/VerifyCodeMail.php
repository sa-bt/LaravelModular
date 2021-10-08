<?php

namespace Sabt\User\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Sabt\User\Models\User;

class VerifyCodeMail extends Mailable
{
    use Queueable, SerializesModels;


    public $code;

    public function __construct($code)
    {
        $this->code = $code;
    }


    public function build()
    {

        return $this->markdown('User::mails.verifyMail')
            ->subject(env('APP_NAME').'-ایجاد حساب کاربری');
    }
}
