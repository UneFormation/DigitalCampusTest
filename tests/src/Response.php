<?php

namespace AppTest;

use AppTest\Trait\PrivateAccess;

class Response extends \App\Response
{
    use PrivateAccess;

    public static function getInstance($statusCode)
    {
        return new static($statusCode);
    }

    public function addHeaderTest($name, $value)
    {
        return parent::addHeader($name, $value);
    }

    public function setStatusCodeTest($code)
    {
        return parent::setStatusCode($code);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function getHeaders()
    {
        return $this->headers;
    }
}