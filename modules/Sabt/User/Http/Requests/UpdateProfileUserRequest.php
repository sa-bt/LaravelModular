<?php


namespace Sabt\User\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Sabt\RolePermissions\Models\Permission;
use Sabt\User\Models\User;

class UpdateProfileUserRequest extends FormRequest
{
    public function authorize()
    {
        return auth()->check() == true;
    }


    public function rules()
    {
//        dd(request()->route('user'));
        $rules = [
            'name'     => ['required', 'min:3', 'max:190'],
            'email'    => 'required|email|unique:users,email,' . auth()->id(),
            'username' => 'nullable|min:3|max:190|unique:users,username,' . auth()->id(),
            'mobile'   => 'nullable|unique:users,mobile,' . auth()->id(),
            'image'    => 'nullable|mimes:jpg,png,jpeg'
        ];

        if (auth()->user()->hasPermissionTo(Permission::TEACH_PERMISSION))
        {
            $rules             += [
                'cart_number' => 'required|string|size:16',
                'shaba'       => 'required|string|size:24',
            ];
            $rules['username'] = ['required', 'min:3', 'max:190', 'unique:users,email,' . auth()->id()];
        }
        return $rules;
    }


}
