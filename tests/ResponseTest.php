<?php

use AppTest\Response;

/**
 * @coversDefaultClass \App\Response
 */
class ResponseTest extends \PHPUnit\Framework\TestCase
{

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     *
     */
    public function testAddHeader()
    {
        $key = 'MaClé'; $value = 'MaValeur';
        $response = Response::getInstance(Response::STATUS_OK);
        $headers = $response->getHeaders();
        $this->assertIsArray($headers);
        $this->assertEmpty($headers);

        $response->addHeaderTest($key, $value);
        $headers = $response->getHeaders();
        $this->assertIsArray($headers);
        $this->assertArrayHasKey($key, $headers);
        $this->assertEquals($value, $headers[$key]);
        $this->assertCount(1, $headers);
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     *
     */
    public function testAddHeaderMultiple()
    {
        $data = [
            'Key1' => 'Value',
            'David' => 'Patiashvili',
            'TOTO' => 'TATA'
        ];
        $response = Response::getInstance(Response::STATUS_OK);
        foreach ($data as $key => $value) {
            $response->addHeaderTest($key, $value);
        }

        $headers = $response->getHeaders();
        $this->assertIsArray($headers);
        $this->assertCount(count($data), $headers);
        foreach ($data as $key => $value) {
            $this->assertArrayHasKey($key, $headers);
            $this->assertEquals($value, $headers[$key]);
        }
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     *
     */
    public function testAddHeaderInvalidKey()
    {
        $response = Response::getInstance(Response::STATUS_OK);

        $this->expectError();
        $response->addHeaderTest(null, 'Value');
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     *
     */
    public function testAddHeaderInvalidValue()
    {
        $response = Response::getInstance(Response::STATUS_OK);

        $this->expectError();
        $response->addHeaderTest('MaKey', null);
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     *
     */
    public function testAddHeaderInvalidKeyValue()
    {
        $response = Response::getInstance(Response::STATUS_OK);

        $this->expectError();
        $response->addHeaderTest(null, null);
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     */
    public function testSetStatusCode()
    {
        $response = Response::getInstance(Response::STATUS_OK);
        $response->setStatusCodeTest(Response::STATUS_OK);
        $statusCode = $response->getStatusCode();
        $this->assertEquals(Response::STATUS_OK, $statusCode);
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     */
    public function testSetStatusCodeInvalidValue()
    {
        $response = Response::getInstance(Response::STATUS_OK);

        $this->expectException(\InvalidArgumentException::class);
        $response->setStatusCodeTest(-200);
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     * @covers ::setBody
     * @covers ::json
     */
    public function testJson()
    {
        $data = [
            'Key1' => 2,
            'K' => 'Toto'
        ];
        $response = Response::json($data, Response::STATUS_UNAUTHORIZED);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::STATUS_UNAUTHORIZED, $response->getStatusCode());

        $headers = $response->getHeaders();
        $this->assertIsArray($headers);
        $this->assertCount(1, $headers);
        $this->assertArrayHasKey('Content-Type', $headers);
        $this->assertGreaterThanOrEqual('application/json', $headers['Content-Type']);

        $this->assertEquals('{"Key1":2,"K":"Toto"}', $response->getBody());
    }

    /**
     * @covers ::__construct
     * @covers ::setStatusCode
     * @covers ::addHeader
     * @covers ::setBody
     * @covers ::text
     */
    public function testText()
    {
        $value = 'Test';
        $response = Response::text($value, Response::STATUS_ERROR);
        $this->assertInstanceOf(Response::class, $response);
        $this->assertEquals(Response::STATUS_ERROR, $response->getStatusCode());

        $headers = $response->getHeaders();
        $this->assertIsArray($headers);
        $this->assertCount(1, $headers);
        $this->assertArrayHasKey('Content-Type', $headers);
        $this->assertGreaterThanOrEqual('text/html', $headers['Content-Type']);

        $this->assertEquals($value, $response->getBody());
    }
}