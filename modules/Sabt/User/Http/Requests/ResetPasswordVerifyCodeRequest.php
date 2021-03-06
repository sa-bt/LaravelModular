<?php

namespace Sabt\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabt\User\Services\VerifyCodeService;

class ResetPasswordVerifyCodeRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'verify_code' => ['required','numeric','between:100000,999999'],
            'email'       => 'required|email'
        ];
    }
}
