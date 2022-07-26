<?php

namespace App;

class Tax
{
    const VAT = 0.2;

    private static function getVatFromAmount(float $amount): float
    {
        return round($amount * static::VAT, 2);
    }
}