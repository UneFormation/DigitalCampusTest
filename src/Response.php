<?php

namespace App;

/**
 *
 */
class Response
{
    const STATUS_OK = 200;
    const STATUS_ERROR = 500;
    const STATUS_UNAUTHORIZED = 401;

    protected int $statusCode;

    protected array $headers = [];

    protected string $body;

    protected function __construct(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    protected function addHeader(string $name, string $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }

    protected function setBody(string $body): static
    {
        $this->body = $body;

        return $this;
    }

    public static function json(array $data, $statusCode = self::STATUS_OK): static
    {
        return (new static($statusCode))
            ->addHeader('Content-Type', 'application/json')
            ->setBody(json_encode($data));
    }

    public static function text(string $body, $statusCode = self::STATUS_OK): static
    {
        return (new static($statusCode))
            ->addHeader('Content-Type', 'text/html')
            ->setBody($body);
    }
}