<?php


namespace Sabt\User\Tests\Feature;


use Sabt\User\Services\VerifyCodeService;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function test_user_can_see_reset_password_form()
    {
        $this->get(route('password.request'))->assertOk();
    }


    public function test_user_can_see_enter_verify_code_form_by_correct_email()
    {
        $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'testbakhshian@gmail.com'])->assertOk();
    }

    public function test_user_cannot_see_enter_verify_code_form_by_wrong_email()
    {
        $this->call('get', route('password.sendVerifyCodeEmail'), ['email' => 'testbakhshian.com'])->assertStatus(302);
    }

    public function test_user_banned_after_6_attempt_to_reset_password()
    {
        for ($i = 0; $i < 5; $i++)
            $this->post( route('password.checkVerifyCode'), ['verify_code','email' => 'testbakhshian@gmail.com'])->assertStatus(302);

        $this->post( route('password.checkVerifyCode'), ['verify_code','email' => 'testbakhshian@gmail.com'])->assertStatus(429);

    }


}
