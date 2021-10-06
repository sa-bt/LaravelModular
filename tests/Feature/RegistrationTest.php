<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Sabt\User\Models\User;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_see_register_form()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    /** @test */
    public function user_can_register()
    {
        $response = $this->register();

        $response->assertRedirect(route('home'));
        $this->assertCount(1, User::all());
    }

    /** @test */
    public function user_have_to_verify_account()
    {
        $user = $this->register();

        $response = $this->get(route('home'));
        $response->assertRedirect(route('verification.notice'));
    }


    /** @test */
    public function verified_user_can_see_home_page()
    {
        $user = $this->register();

        $this->assertAuthenticated();

        auth()->user()->markEmailAsVerified();
        $response = $this->get(route('home'));
        $response->assertOk();
    }

    public function register()
    {
        return $this->post(route('register'), [
            "name"                  => "sabt",
            "email"                 => "sabt@sabt.com",
            "mobile"                => "09169630567",
            "password"              => "q@Q111111",
            "password_confirmation" => "q@Q111111",
        ]);
    }
}
