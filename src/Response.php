<?php

namespace App;

/**
 * david.patiashvili@uneformation.fr
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
        $this->setStatusCode($statusCode);
    }

    protected function addHeader(string $name, string $value): static
    {
        $this->headers[$name] = $value;

        return $this;
    }

    protected function setStatusCode(int $statusCode)
    {
        $availableCodes = [
            static::STATUS_OK,
            static::STATUS_ERROR,
            static::STATUS_UNAUTHORIZED
        ];
        if (!in_array($statusCode, $availableCodes, true)) {
            throw new \InvalidArgumentException('Not authorized status code : ' . $statusCode);
        }
        $this->statusCode = $statusCode;

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