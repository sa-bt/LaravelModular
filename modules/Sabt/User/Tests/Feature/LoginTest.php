<?php

namespace Sabt\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Sabt\User\Models\User;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_validate_email_and_password()
    {
        $user = User::factory(1)->create()->first();
        $response=$this->post(route('login'), [
            "email" => "",
            "password" => "",
        ]);
//        $errors = session('errors');

        $response->assertSessionHasErrors([
            'email' => __('validation.required', ['attribute' => 'ایمیل'])]);
//        $this->assertSame($errors->first('email'), __('validation.required', ['attribute' => 'ایمیل']));
//        $this->assertSame($errors->first('password'), __('validation.required', ['attribute' => 'رمز عبور']));
    }

    public function test_user_can_login_by_email()
    {
        $user = User::factory(1)->create()->first();
        $this->post(route('login'), [
            "email" => $user->email,
            "password" => "password",
        ]);
        $this->assertAuthenticated();
    }

    public function test_user_can_login_by_mobile()
    {
        $user = User::factory(1)->create([
            "mobile" => "09169630567"
        ])->first();
        $this->post(route('login'), [
            "email" => $user->mobile,
            "password" => "password",
        ]);
        $this->assertAuthenticated();
    }
}
