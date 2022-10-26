<?php

namespace Sabt\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabt\User\Services\VerifyCodeService;

class SendResetPasswordVerifyCodeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'email' => ['required','email']
        ];
    }
}
