<?php


namespace Sabt\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class UpdateUserPhoto extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        return [
            'image' => ['required','mimes:jpg,jpeg,png']
        ];
    }
}
