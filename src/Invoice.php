<?php

namespace App;

class Invoice
{
    const VAT_PERCENT = 0.2;

    public string $firstname;

    private string $lastname;

    protected float $amount;

    static public array $firstnames = [];

    static private array $lastnames = [];

    static protected array $amounts = [];

    static private self $instance;

    protected function __construct()
    {

    }

    public static function getInstance(): static
    {
        if (isset(static::$instance)) {
            return static::$instance;
        }

        static::$instance = new static();
        return static::$instance;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    protected function getFirstname(): string
    {
        return $this->firstname;
    }

    private function getLastname(): string
    {
        return $this->lastname;
    }

    public static function getAmountFromAmountWithVat(float $amount): float
    {
        return $amount / (1 + static::VAT_PERCENT);
    }

    protected static function getAmountFromAmountWithoutVat(float $amount): float
    {
        return $amount * (1 + static::VAT_PERCENT);
    }

    private static function getVatAmountFromAmount(float $amount): float
    {
        return $amount * static::VAT_PERCENT;
    }

    protected static function controlArgsAsFloat(array $args): void
    {
        array_map(function(float $value) {
            return $value;
        }, $args);
    }

    protected static function sum(...$args): float
    {
        static::controlArgsAsFloat($args);
        return array_sum($args);
    }

    public static function multiply(...$args): float
    {
        static::controlArgsAsFloat($args);
        return array_product($args);
    }

    public static function divisionBy(float $a, float $b): float
    {
        return round($a / $b, 2);
    }

}