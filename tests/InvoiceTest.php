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
     * @covers ::controlArgsAsFloat
     */
    public function testSum()
    {
        $asserts = [
            [[10.32, 10.34, 0], 20.66],
            [[-10.32, -10.34, 0], -20.66],
            [[0, -10.34], -10.34],
            [[0, 0], 0],
            [[-10.34, 10.34], 0],
        ];
        foreach ($asserts as $index => $assert) {
            list($numbers, $expected) = $assert;
            $result = Invoice::sum(...$numbers);
            $this->assertEquals($expected, $result, "Failed {$index}");
        }
    }

    /**
     * @covers ::sum
     * @covers ::controlArgsAsFloat
     */
    public function testSumInvalidParamsString()
    {
        $this->expectError();
        Invoice::sum('string', 0.3);
    }

    /**
     * @covers ::sum
     * @covers ::controlArgsAsFloat
     */
    public function testSumInvalidParamsNull()
    {
        $this->expectError();
        Invoice::sum(19.34, null);
    }

    /**
     * @covers ::multiply
     * @covers ::controlArgsAsFloat
     */
    public function testMultiply()
    {
        $asserts = [
            [[10, 10.34, 1], 103.4],
            [[-10.32, -10, 1], 103.2],
            [[10, -10.34], -103.4],
            [[0, 1], 0],
            [[-10, 10.34], -103.4],
        ];
        foreach ($asserts as $index => $assert) {
            list($numbers, $expected) = $assert;
            $result = Invoice::multiply(...$numbers);
            $this->assertEquals($expected, $result, "Failed {$index}");
        }
    }

    /**
     * @covers ::multiply
     * @covers ::controlArgsAsFloat
     */
    public function testMultiplyInvalidParamsString()
    {
        $this->expectError();
        Invoice::multiply('string', 0.3);
    }

    /**
     * @covers ::multiply
     * @covers ::controlArgsAsFloat
     */
    public function testMultiplyInvalidParamsNull()
    {
        $this->expectError();
        Invoice::multiply(19.34, null);
    }
}