<?php

namespace Sabt\User\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabt\User\Rules\ValidPasswordRule;
use Sabt\User\Services\VerifyCodeService;

class ChangePasswordRequest extends FormRequest
{

    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        return [
            'password' => ['required','confirmed', new ValidPasswordRule()]
        ];
    }
}
