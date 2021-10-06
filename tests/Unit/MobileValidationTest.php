<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Sabt\User\Rules\ValidMobileRule;

class MobileValidationTest extends TestCase
{

    public function test_mobile_can_not_be_less_than_11_characters()
    {
        $result=(new ValidMobileRule())->passes('','9169630567');
        $this->assertEquals(0,$result);
    }

    public function test_mobile_can_not_be_more_than_11_characters()
    {
        $result=(new ValidMobileRule())->passes('','091696305607');
        $this->assertEquals(0,$result);
    }

    public function test_mobile_should_start_by_09()
    {
        $result=(new ValidMobileRule())->passes('','91696305607');
        $this->assertEquals(0,$result);
    }
}
