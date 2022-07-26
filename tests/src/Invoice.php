<?php

namespace AppTest;

use AppTest\Trait\PrivateAccess;

class Invoice extends \App\Invoice
{
    use PrivateAccess;

    public static function multiplyTest(...$args)
    {
        return static::exposedMethod('multiply', ...$args);
    }

    public static function sum(...$args): float
    {
        return parent::sum(...$args);
    }
}