<?php


namespace Sabt\User\Tests\Feature;


use Sabt\User\Services\VerifyCodeService;
use Tests\TestCase;

class VerifyCodeServiceTest extends TestCase
{
    public function test_generated_code_is_6_digit()
    {
        $code = VerifyCodeService::generate();
        $this->assertIsNumeric($code, 'Generate code is not numeric');
        $this->assertGreaterThanOrEqual(100000, $code, 'Generated code is greater than 999999 ');
        $this->assertLessThanOrEqual(999999, $code, 'Generated code is less than 999999 ');
    }

    public function test_verify_code_can_store()
    {
        $code = VerifyCodeService::generate();
        VerifyCodeService::store(1,$code);

        $this->assertEquals($code,cache()->get('verify_code_1'));
    }
}
