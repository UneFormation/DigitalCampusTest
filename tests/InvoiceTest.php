<?php

use \PHPUnit\Framework\TestCase;

use App\Invoice;

/**
 * @coversDefaultClass App\Invoice
 */
class InvoiceTest extends TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstructOff()
    {
        $this->expectError();
        new Invoice();
    }

    /**
     * @covers ::getInstance
     */
    public function testSingleton()
    {
        $first = Invoice::getInstance();
        $second = Invoice::getInstance();
        $this->assertSame($first, $second);
    }

    /**
     * @covers ::sum
     */
    public function testSum()
    {
        $asserts = [
            [10.32, 10.34, 20.66],
            [-10.32, -10.34, -20.66],
            [0, -10.34, -10.34],
            [0, 0, 0],
            [-10.34, 10.34, 0],
        ];
        foreach ($asserts as $index => $assert) {
            list($a, $b, $expected) = $assert;
            $result = Invoice::sum($a, $b);
            $this->assertEquals($expected, $result, "Failed {$index}");
        }
    }

    /**
     * @covers ::sum
     */
    public function testSumInvalidParamsString()
    {
        $this->expectError();
        Invoice::sum('string', 0.3);
    }

    /**
     * @covers ::sum
     */
    public function testSumInvalidParamsNull()
    {
        $this->expectError();
        Invoice::sum(19.34, null);
    }

}