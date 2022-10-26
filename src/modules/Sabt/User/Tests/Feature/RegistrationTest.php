<?php

namespace Sabt\User\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Sabt\RolePermissions\Database\Seeders\RoleAndPermissionSeeder;
use Sabt\User\Models\User;
use Sabt\User\Services\VerifyCodeService;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed(RoleAndPermissionSeeder::class);
    }

    /** @test */
    public function user_can_see_register_form()
    {
        $response = $this->get(route('register'));
        $response->assertStatus(200);
    }

    public function test_validate_email_and_password()
    {
        $response=$this->post(route('register'), [
            "name"                  => "sabt",
            "email"                 => "",
            "mobile"                => "09169630567",
            "password"              => "q@Q111111",
            "password_confirmation" => "q@Q111111",
        ]);
        $response->assertInvalid([
            'email'=>__('validation.required', ['attribute' => 'ایمیل'])]);
//        $errors = session('errors');
//$this->assertEquals($response->me);
//        $response->assertSessionHasErrors([
//            'email' => __('validation.required', ['attribute' => 'ایمیل'])]);
//        $this->assertSame($errors->first('email'), __('validation.required', ['attribute' => 'ایمیل']));
//        $this->assertSame($errors->first('password'), __('validation.required', ['attribute' => 'رمز عبور']));
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


    /** @test */
    public function user_can_verify_account()
    {
        $user = User::factory(1)->create()->first();
        $code=VerifyCodeService::generate();
        VerifyCodeService::store($user->id,$code,120);
        auth()->loginUsingId($user->id);
        $this->assertAuthenticated();
        $this->post(route('verification.verify'),[
            'verify_code'=>$code
        ]);
        $this->assertEquals(true,$user->hasVerifiedEmail());

    }

    public function register()
    {
        return $this->post(route('register'), [
            "name"                  => "sabt",
            "email"                 => "testbakhshian@gmail.com",
            "mobile"                => "09169630567",
            "password"              => "q@Q111111",
            "password_confirmation" => "q@Q111111",
        ]);
    }


}
