<?php

require __DIR__ . '/../vendor/autoload.php';

$invoice = App\Invoice::getInstance();
$invoice2 = App\Invoice::getInstance();

var_dump($invoice === $invoice2);
