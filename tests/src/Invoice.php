<?php

namespace AppTest;

class Invoice extends \App\Invoice
{
    public static function sum(...$args): float
    {
        return parent::sum(...$args);
    }
}