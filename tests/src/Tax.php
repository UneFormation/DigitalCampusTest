<?php

namespace AppTest;

use AppTest\Trait\PrivateAccess;

class Tax extends \App\Tax
{
    use PrivateAccess;

    public static function getVatFromAmountTest($amount)
    {
        return static::exposedMethod('getVatFromAmount', $amount);
    }
}