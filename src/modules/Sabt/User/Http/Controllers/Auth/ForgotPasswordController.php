<?php

namespace Sabt\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Sabt\User\Http\Requests\ResetPasswordVerifyCodeRequest;
use Sabt\User\Http\Requests\SendResetPasswordVerifyCodeRequest;
use Sabt\User\Repositories\UserRepository;
use Sabt\User\Services\VerifyCodeService;


class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    public function showVerifyCodeRequestForm()
    {
        return view('User::auth.passwords.email');
    }

    public function sendVerifyCodeEmail(SendResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepository::class)->findByEmail($request->email);

        if ($user && !VerifyCodeService::has($user->id))
            $user->sendResetPasswordRequestNotification();

        return view('User::auth.passwords.forgetPasswordVerifyCode');
    }

    public function checkVerifyCode(ResetPasswordVerifyCodeRequest $request)
    {
        $user = resolve(UserRepository::class)->findByEmail($request->email);
        if ($user == null || !VerifyCodeService::check($user->id, $request->verify_code))
            return back()->withErrors(["verify_code" => "کد وارد شده معتبر نمی باشد!"]);

        auth()->loginUsingId($user->id);
        return redirect()->route('password.showResetForm');
    }

}
