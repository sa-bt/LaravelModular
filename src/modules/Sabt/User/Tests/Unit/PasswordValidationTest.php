<?php

namespace Sabt\User\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Sabt\User\Rules\ValidPasswordRule;

class PasswordValidationTest extends TestCase
{


    public function test_password_should_not_be_less_than_8_characters()
    {
        $result=(new ValidPasswordRule())->passes('','Q@q1111');
        $this->assertEquals(0,$result);
    }

    public function test_password_should_be_have_capital_character()
    {
        $result=(new ValidPasswordRule())->passes('','q@q11111');
        $this->assertEquals(0,$result);
    }


    public function test_password_should_be_have_small_character()
    {
        $result=(new ValidPasswordRule())->passes('','Q@Q11111');
        $this->assertEquals(0,$result);
    }

    public function test_password_should_be_have_special_character()
    {
        $result=(new ValidPasswordRule())->passes('','Q@q11111');
        $this->assertEquals(1,$result);
    }

    public function test_password_should_be_have_digit_character()
    {
        $result=(new ValidPasswordRule())->passes('','Q@q!ww$fdf');
        $this->assertEquals(0,$result);
    }
}
