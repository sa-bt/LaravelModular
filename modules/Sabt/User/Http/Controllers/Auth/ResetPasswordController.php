<?php

namespace Sabt\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Sabt\User\Http\Requests\ChangePasswordRequest;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;


    public function showResetForm(Request $request)
    {
        return view('User::auth.passwords.reset')->with(
            ['email' => $request->email]
        );
    }

    public function reset(ChangePasswordRequest $request)
    {
        auth()->user()->password = bcrypt($request->password);
        auth()->user()->save();
        return redirect(route('home'));
    }

}
