<?php


namespace Sabt\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class AddRoleRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
        return [
            'role' => ['required','exists:roles,name']
        ];
    }
}
