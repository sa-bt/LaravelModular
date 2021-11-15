<?php


namespace Sabt\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Sabt\User\Models\User;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
//        dd(request()->route('user'));
        return [
            'name'     => ['required', 'min:3', 'max:190'],
            'email'    => 'required|email|unique:users,email,' . request()->route('user')->id,
            'username' => 'nullable|min:3|max:190|unique:users,username,' . request()->route('user')->id,
            'mobile'   => 'nullable|unique:users,mobile,' . request()->route('user')->id,
            'status'   => ['required', Rule::in(User::$statuses)],
            'image'    => 'nullable|mimes:jpg,png,jpeg'
        ];
    }


}
