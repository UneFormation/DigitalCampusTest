<?php

use \PHPUnit\Framework\TestCase;

use AppTest\Tax;

/**
 * @coversDefaultClass App\Tax
 */
class TaxTest extends TestCase
{
    /**
     * @covers ::getVatFromAmount
     */
    public function testGetVatFromAmount()
    {
        $asserts = [
            10 => 2,
            100 => 20,
            5 => 1,
            -20 => -4
        ];
        foreach ($asserts as $amount => $expected) {
            $result = Tax::getVatFromAmountTest($amount);
            $this->assertEquals($expected, $result, "Faile on $amount");
        }
    }

    /**
     * @covers ::getVatFromAmount
     */
    public function testGetVatFromAmountInvalidParamsString()
    {
        $this->expectError();
        Tax::getVatFromAmountTest('string');
    }

    /**
     * @covers ::getVatFromAmount
     */
    public function testGetVatFromAmountInvalidParamsNull()
    {
        $this->expectError();
        Tax::getVatFromAmountTest(null);
    }
}